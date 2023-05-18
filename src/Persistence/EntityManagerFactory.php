<?php

namespace App\Persistence;

use App\Utility\PsrCompatibleContainer;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Exception\MissingMappingDriverImplementation;
use Doctrine\ORM\ORMSetup;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class EntityManagerFactory
{
    private array $settings;
    private array $config;

    /**
     * @param  PsrCompatibleContainer $c
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __construct(PsrCompatibleContainer $c)
    {
        $this->settings = $c->get('settings');
        $this->config = $c->get('settings')[self::class];
    }

    /**
     * @return EntityManager
     * @throws Exception
     * @throws MissingMappingDriverImplementation
     */
    public function create(): EntityManager
    {
        $appRoot = $this->settings['APP_ROOT'];

        // Create a simple "default" Doctrine ORM configuration for Attributes
        $config = ORMSetup::createAttributeMetadataConfiguration(
            paths: array($appRoot . "/src/Persistence/Entity"),
            isDevMode: true,
        );

        // configuring the database connection
        $connection = DriverManager::getConnection(
            [
            'driver' => 'pdo_sqlite',
            'path' => $appRoot . '/var/db/database.sqlite',
            ],
            $config
        );

        // obtaining the entity manager
        return new EntityManager($connection, $config);
    }
}
