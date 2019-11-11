<?php

declare(strict_types=1);

/*
 * Immobilienscout24 bundle for Contao Open Source CMS
 *
 * @copyright  Copyright © derhaeuptling (https://derhaeuptling.com/)
 * @author     Moritz Vondano
 * @license    MIT
 */

namespace Derhaeuptling\ContaoImmoscout24\Synchronizer;

use Contao\Dbafs;
use Contao\FilesModel;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use Webmozart\PathUtil\Path;

class FileScraper
{
    /** @var Client */
    private $client;

    /** @var string */
    private $projectDir;

    public function __construct(string $projectDir)
    {
        $this->client = new Client(
            [
                'defaults' => [
                    'headers' => ['User-Agent' => 'Contao Web Scraper'],
                ],
            ]
        );

        $this->projectDir = $projectDir;
    }

    public function scrape(string $sourceUri, string $targetPath): ?FilesModel
    {
        $this->ensureFolderExists($targetPath);
        $this->deleteFileIfExisting($targetPath);

        try {
            // synchronous download
            $this->client->send(
                new Request('get', $sourceUri),
                [
                    'sink' => $targetPath,
                ]
            );

            // add to DBAFS
            $relativePath = Path::makeRelative($targetPath, $this->projectDir);

            // todo meta data
            return Dbafs::addResource($relativePath);
        } catch (GuzzleException | \Exception $e) {
            $this->deleteFileIfExisting($targetPath);

            return null;
        }
    }

    private function ensureFolderExists(string $path): void
    {
        $dir = Path::getDirectory($path);

        if (!file_exists($dir) && !mkdir($dir, 0777, true) && !is_dir($dir)) {
            throw new \RuntimeException(sprintf('Directory "%s" could not be created.', $dir));
        }
    }

    private function deleteFileIfExisting(string $path): void
    {
        if (file_exists($path)) {
            unlink($path);
        }
    }
}
