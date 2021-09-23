<?php

declare(strict_types=1);

/*
 * Immobilienscout24 bundle for Contao Open Source CMS
 *
 * @copyright  Copyright © derhaeuptling (https://derhaeuptling.com/)
 * @author     Moritz Vondano
 * @license    MIT
 */

namespace Derhaeuptling\ContaoImmoscout24\Controller\BackEnd;

use Contao\CoreBundle\Framework\ContaoFramework;
use Contao\CoreBundle\Translation\Translator;
use Contao\Message;
use Derhaeuptling\ContaoImmoscout24\Entity\Account;
use Derhaeuptling\ContaoImmoscout24\OAuth\Server;
use Derhaeuptling\ContaoImmoscout24\Repository\AccountRepository;
use Doctrine\ORM\EntityManagerInterface;
use League\OAuth1\Client\Credentials\CredentialsException;
use League\OAuth1\Client\Credentials\TemporaryCredentials;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use System;

class AccessTokenController extends AbstractController
{
    public const SESSION_KEY__TEMPORARY_CREDENTIALS = 'immoscout24.temporary_credentials';
    public const SESSION_KEY__ACCOUNT = 'immoscout24.account';
    public const SESSION_KEY__BASE_URI = 'immoscout24.base_uri';

    /** @var Security */
    private $security;

    /** @var AccountRepository */
    private $accountRepository;

    /** @var EntityManagerInterface */
    private $entityManager;

    /** @var Translator */
    private $translator;

    /** @var ContaoFramework */
    private $framework;

    public function __construct(Security $security, AccountRepository $accountRepository, EntityManagerInterface $entityManager, Translator $translator, ContaoFramework $framework)
    {
        $this->security = $security;
        $this->accountRepository = $accountRepository;
        $this->entityManager = $entityManager;
        $this->translator = $translator;
        $this->framework = $framework;
    }

    /**
     * @Route("_immoscout24/confirm",
     *     name="immoscout24_confirm",
     *     defaults={
     *          "_scope" = "backend",
     *          "_token_check" = true,
     *     }
     * )
     */
    public function generateToken(Request $request): Response
    {
        if (!$this->security->isGranted('ROLE_USER')) {
            throw $this->createAccessDeniedException();
        }

        if (!$request->query->has('oauth_token') || !$request->query->has('oauth_verifier')) {
            return new Response('Missing OAuth token/verifier information.', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        // Retrieve process information from session
        if (!$request->hasSession()) {
            throw new \RuntimeException('Could not access session.');
        }

        $session = $request->getSession();

        $temporaryCredentials = unserialize(
            $session->get(self::SESSION_KEY__TEMPORARY_CREDENTIALS),
            ['allowed_classes' => [TemporaryCredentials::class]]
        );

        if (!$temporaryCredentials instanceof TemporaryCredentials) {
            throw new \RuntimeException('Could not fetch temporary credentials.');
        }

        $accountId = $session->get(self::SESSION_KEY__ACCOUNT);

        if (null === ($account = $this->accountRepository->find($accountId))) {
            return new Response('No associated account was found.', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        // Update entity
        $this->updateTokenCredentials(
            $account,
            $temporaryCredentials,
            $request->query->get('oauth_token'),
            $request->query->get('oauth_verifier')
        );

        // Clean up session
        $session->remove(self::SESSION_KEY__TEMPORARY_CREDENTIALS);
        $session->remove(self::SESSION_KEY__ACCOUNT);
        $baseUri = $session->remove(self::SESSION_KEY__BASE_URI);

        // Redirect back
        return new RedirectResponse($baseUri);
    }

    private function updateTokenCredentials(Account $account, TemporaryCredentials $temporaryCredentials, string $oAuthToken, string $oAuthVerifier): void
    {
        // Make sure language files are loaded before adding flash messages
        $this->framework->initialize();
        System::loadLanguageFile('tl_immoscout24_account');

        $accountCredentials = $account->getCredentials();

        $server = new Server(
            $accountCredentials->getConsumerKey(),
            $accountCredentials->getConsumerSecret()
        );

        // Get token credentials from server
        try {
            $tokenCredentials = $server->getTokenCredentials($temporaryCredentials, $oAuthToken, $oAuthVerifier);
        } catch (CredentialsException $e) {
            Message::addError(
                $this->translator->trans('tl_immoscout24_account.access_token_error_2', [], 'contao_default')
            );

            return;
        }

        // Persist changes to account
        $accountCredentials->setAccessTokenCredentials($tokenCredentials);
        $this->entityManager->flush();

        Message::addInfo(
            $this->translator->trans('tl_immoscout24_account.access_token_success', [], 'contao_default')
        );
    }
}
