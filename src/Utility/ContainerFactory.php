<?php

/**
 * Copyright (c) 2023 Martin Toennishoff
 */

namespace App\Utility;

use App\Logger\LoggerFactory;
use App\Persistence\EntityManagerFactory;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Log\LoggerInterface;

/**
 * Builds the DI/Service provider container
 */
class ContainerFactory
{
    /**
     * @var bool
     */
    private static bool $logToConsole = false;

    /**
     * @param  bool $logToConsole
     * @return void
     */
    public static function setLogToConsole(bool $logToConsole): void
    {
        self::$logToConsole = $logToConsole;
    }

    /**
     * Create a new container with the given settings
     *
     * @param array $settings Settings to use
     *
     * @return PsrCompatibleContainer
     */
    public static function fromSettings(array $settings): PsrCompatibleContainer
    {
        $container = new PsrCompatibleContainer();
        $settings['APP_ROOT'] = realpath(__DIR__ . '/../../');
        $container['settings'] = $settings;
        self::addDependencies($container);
        return $container;
    }

    /**
     * Create a new container with the same settings as the given container
     *
     * @param ContainerInterface $container Container to extract settings from
     *
     * @return PsrCompatibleContainer
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public static function fromContainer(ContainerInterface $container): PsrCompatibleContainer
    {
        return self::fromSettings($container->get('settings'));
    }

    /**
     * Add LoggerFactory and other factories/services
     *
     * @param                                 PsrCompatibleContainer $container
     * @suppressWarnings(PHPMD.ShortVariable)
     */
    private static function addDependencies(PsrCompatibleContainer $container): void
    {
        $container[LoggerFactory::class] = fn (PsrCompatibleContainer $c) => new LoggerFactory($c, self::$logToConsole);
        $container[LoggerInterface::class] =
            fn (PsrCompatibleContainer $c) => $c->offsetGet(LoggerFactory::class)->getDefaultLogger();
        $container[EntityManagerFactory::class] = fn (PsrCompatibleContainer $c) => new EntityManagerFactory($c);
    }
}
