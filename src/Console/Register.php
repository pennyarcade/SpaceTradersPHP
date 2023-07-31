<?php

namespace App\Console;

use App\Persistence\Entity\Agent;
use App\Persistence\Entity\Faction;
use App\Persistence\EntityManagerFactory;
use App\SpaceTraders\ApiService;
use App\SpaceTraders\Dto\Contract;
use App\SpaceTraders\Dto\Ship;
use App\SpaceTraders\Enum\FactionName;
use Doctrine\ORM\EntityManager;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Input\InputArgument;

class Register extends BaseCommand
{
    private ApiService $api;
    private EntityManager $db;
    private LoggerInterface $log;

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
        $this->db = $this->container->get(EntityManagerFactory::class)->create();
        $this->log = $this->container->get(LoggerInterface::class);
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
            $this->input->getArgument('symbol'),
            null
        );
        $result = json_decode($response->getBody()->getContents(), true);

        if ($response->getStatusCode() > 299) {
            $result = $result['error'];
            $this->error('Code: ' . $result['code']);
            $this->error($result['message']);
            // Do something with error data
            // $this->error(print_r($result['error']['data'], true));
            $this->log->error(
                $result['code'] . ': ' . $result['message'],
                $result
            );
            return 1;
        }
        $result = $result['data'];
        $result['agent']['token'] = $result['token'];
        $agent = Agent::fromArray($result['agent']);
        $contract = Contract::fromArray($result['contract']);
        $faction = Faction::fromArray($result['faction']);
        $ship = Ship::fromArray($result['ship']);

        var_dump($result);
        var_dump($response->getStatusCode());

        return 0;
    }

    protected function tearDown(): void
    {
    }
}
