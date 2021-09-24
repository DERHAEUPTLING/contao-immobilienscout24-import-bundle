<?php

declare(strict_types=1);

/*
 * Immobilienscout24 bundle for Contao Open Source CMS
 *
 * @copyright  Copyright © derhaeuptling (https://derhaeuptling.com/)
 * @author     Moritz Vondano
 * @license    MIT
 */

namespace Derhaeuptling\ContaoImmoscout24\EventListener\DataContainer;

use Contao\CoreBundle\Exception\RedirectResponseException;
use Contao\CoreBundle\ServiceAnnotation\Callback;
use Contao\CoreBundle\Translation\Translator;
use Contao\DataContainer;
use Contao\Message;
use Derhaeuptling\ContaoImmoscout24\Controller\BackEnd\AccessTokenController;
use Derhaeuptling\ContaoImmoscout24\Entity\Account as AccountEntity;
use Derhaeuptling\ContaoImmoscout24\OAuth\Server;
use Derhaeuptling\ContaoImmoscout24\Repository\AccountRepository;
use League\OAuth1\Client\Credentials\CredentialsException;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class Account
{
    /** @var AccountRepository */
    private $accountRepository;

    /** @var Translator */
    private $translator;

    /** @var RequestStack */
    private $requestStack;

    /** @var UrlGeneratorInterface */
    private $urlGenerator;

    /**
     * Account constructor.
     */
    public function __construct(AccountRepository $accountRepository, Translator $translator, RequestStack $requestStack, UrlGeneratorInterface $urlGenerator)
    {
        $this->accountRepository = $accountRepository;
        $this->translator = $translator;
        $this->requestStack = $requestStack;
        $this->urlGenerator = $urlGenerator;
    }

    /**
     * @Callback(table="tl_immoscout24_account", target="list.label.label")
     */
    public function onLabelCallback(array $row): string
    {
        /** @var AccountEntity $account */
        $account = $this->accountRepository->find($row['id']);

        $syncedElementsLabel = sprintf(
            $this->translator->trans('tl_immoscout24_account.imported_elements', [], 'contao_default'),
            \count($account->getRealEstates())
        );

        return sprintf(
            '%s<span style="color: #999; margin-left: .5em;">[%s]</span>',
            $account->getDescription(),
            $syncedElementsLabel
        );
    }

    /**
     * @Callback(table="tl_immoscout24_account", target="config.onsubmit")
     */
    public function provisionAccessToken(DataContainer $dc): void
    {
        if ('1' !== $_POST['provision_access_token']) {
            return;
        }

        $callbackUri = $this->urlGenerator->generate(
            'immoscout24_confirm',
            [],
            UrlGeneratorInterface::ABSOLUTE_URL
        );

        $server = new Server(
            $dc->activeRecord->api_consumer_key,
            $dc->activeRecord->api_consumer_secret,
            $callbackUri
        );

        // Get temporary credentials
        try {
            $temporaryCredentials = $server->getTemporaryCredentials();
        } catch (CredentialsException $e) {
            Message::addError(
                $this->translator->trans('tl_immoscout24_account.access_token_error_1', [], 'contao_default')
            );

            return;
        }

        if (null === ($request = $this->requestStack->getCurrentRequest()) || !$request->hasSession()) {
            throw new \RuntimeException('Could not access session.');
        }

        // Persist process information into session
        $session = $request->getSession();

        $session->set(AccessTokenController::SESSION_KEY__TEMPORARY_CREDENTIALS, serialize($temporaryCredentials));
        $session->set(AccessTokenController::SESSION_KEY__ACCOUNT, (int) $dc->id);
        $session->set(AccessTokenController::SESSION_KEY__BASE_URI, $request->getUri());

        // Redirect
        $authorizationUrl = $server->getAuthorizationUrl($temporaryCredentials);

        throw new RedirectResponseException($authorizationUrl);
    }
}
