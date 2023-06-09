<?php

namespace App\Console\Agent;

use App\Console\BaseCommand;
use App\SpaceTraders\ApiService;
use App\SpaceTraders\Enum\FactionName;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Symfony\Component\Console\Input\InputArgument;

class Register extends BaseCommand
{
    private ApiService $api;

    protected function configure()
    {
        $this
            ->setName('agent:register')
            // the short description shown while running "php bin/console list"
            ->setDescription('Registers a new agent')
            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('Registers a new agent')
            ->addArgument(
                'symbol',
                InputArgument::OPTIONAL,
                'Your agent callsign'
            )
            ->addArgument(
                'factionSymbol',
                InputArgument::OPTIONAL,
                'Your faction symbol: ' . implode(', ', array_column(FactionName::cases(), 'name'))
            );
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
     * @throws     GuzzleException
     */
    protected function perform(): int
    {
        $this->api->toggleExceptions();
        $response = $this->api->register(
            FactionName::tryFromName($this->input->getArgument('factionSymbol')),
            $this->input->getArgument('symbol')
        );
        // TODO: Do something with the response -.-
        return 0;
    }

    protected function tearDown(): void
    {
    }
}
