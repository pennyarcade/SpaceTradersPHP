<?php

namespace App\Console\My;

use App\Console\BaseCommand;
use App\Persistence\Entity\Agent as AgentEntity;
use App\Persistence\EntityManagerFactory;
use App\SpaceTraders\ApiService;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Exception\MissingMappingDriverImplementation;
use Doctrine\ORM\Exception\NotSupported;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Symfony\Component\Console\Input\InputArgument;

class Agent extends BaseCommand
{
    private ApiService $api;
    private EntityManager $db;

    protected function configure()
    {
        $this
            ->setName('my:agent')
            // the short description shown while running "php bin/console list"
            ->setDescription('Get my agent data')
            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('Get my agent data')
            ->addArgument('agent', InputArgument::REQUIRED, 'Agent name')
        ;
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws Exception
     * @throws MissingMappingDriverImplementation
     */
    protected function setUp(): void
    {
        $this->api = new ApiService($this->container);
        $this->db = $this->container->get(EntityManagerFactory::class)->create();
    }

    /**
     * @inheritDoc
     * @return int
     * @throws GuzzleException
     * @throws NotSupported
     */
    protected function perform(): int
    {
        $this->api->toggleExceptions();
        /** @var AgentEntity $agent */
        $agent = $this->db->getRepository(AgentEntity::class)
            ->findOneBy(['accountId' => $this->input->getArgument('agent')]);

        $response = $this->api->getMyAgent($agent->getToken());
        $result = json_decode($response->getBody()->getContents(), true);
        var_dump($result);
        var_dump($response->getStatusCode());
        return 0;
    }

    protected function tearDown(): void
    {
    }
}
