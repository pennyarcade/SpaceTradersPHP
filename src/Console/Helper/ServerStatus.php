<?php

namespace App\Console\Helper;

use App\Console\BaseCommand;
use App\SpaceTraders\ApiService;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class ServerStatus extends BaseCommand
{
    private ApiService $api;

    protected function configure()
    {
        $this
            ->setName('helper:server_status')
            // the short description shown while running "php bin/console list"
            ->setDescription('Get server status')
            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('Get server status')
        ;
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    protected function setUp(): void
    {
        $this->api = new ApiService($this->container);
    }

    /**
     * @inheritDoc
     * @throws GuzzleException
     */
    protected function perform(): int
    {
        $this->api->toggleExceptions();
        // TODO: Call without token
        $response = $this->api->getServerStatus();
        $result = json_decode($response->getBody()->getContents());
        var_dump($result);
        return 0;
    }

    protected function tearDown(): void
    {
    }
}
