<?php

namespace App\Logger;

use ArrayObject;
use Gelf\Publisher as GelfPublisher;
use Gelf\Transport\UdpTransport;
use Monolog\Handler\GelfHandler;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\ProcessIdProcessor;
use Monolog\Processor\PsrLogMessageProcessor;
use Monolog\Processor\UidProcessor;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Log\LoggerInterface;

/**
 * Class LoggerFactory
 * create Monolog Logger instances
 * @package App\Infrastructure\Logger
 */
class LoggerFactory
{
    private array $settings;
    private bool $logToConsole;

    /**
     * LoggerFactory constructor.
     * @param ContainerInterface $container
     * @param bool $toConsole
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __construct(ContainerInterface $container, bool $toConsole = false)
    {
        $this->settings = $container->get('settings')[LoggerInterface::class];
        $this->logToConsole = $toConsole;
    }

    /**
     * guarantee the same log structure regardless of attached streams/handlers
     *
     * @param string|null $name
     * @return Logger
     */
    private function getHandlelessLogger(?string $name = null): Logger
    {
        return (new Logger($name ?? $this->settings['name']))
            ->pushProcessor(new UidProcessor());
    }

    /**
     * Create file loggers with custom or default settings
     *
     * @param string|null $name
     * @param string|null $path
     * @param string|int|null $level
     * @return Logger
     */
    public function getFileLogger(?string $name = null, ?string $path = null, $level = null): Logger
    {
        $logName = ($path ?? $this->settings['path']) . "/" . ($name ?? $this->settings['name']);
        if ($this->logToConsole) {
            $level = $this->getLogLevelByEnvironmentVerbosity();
        }
        $logger = $this->getHandlelessLogger($name)
            ->pushHandler(
                new StreamHandler($logName, $level ?? $this->settings['level'])
            );
        if ($this->settings['logServerEnabled']) {
            $logger->pushHandler(
                new GelfHandler(
                    publisher:  new GelfPublisher(
                        new UdpTransport(
                            $this->settings['logServerHost'],
                            $this->settings['logServerPort']
                        )
                    ),
                    level: $this->settings['logServerLevel'] ?? $this->settings['level']
                )
            );
        }
        return $logger;
    }

    /**
     * Gets a logger that logs into a date-rotating filename.
     * According to Monolog, those loggers should be idempotent.
     *
     * @param string|null $name
     * @param string|null $path
     * @param int|null $minLogLevel
     *
     * @param bool $toConsole
     * @return Logger
     */
    public function getRotatingFileLogger(
        ?string $name,
        ?string $path = null,
        ?int $minLogLevel = null,
        bool $toConsole = false
    ): Logger {
        $logName = ($name ?? $this->settings['name']);
        $log = $this->getHandlelessLogger($logName);
        $logRotationHandler = new RotatingFileHandler(
            ($path ?? $this->settings['path']) . '/' . $logName,
            $this->settings['maxFiles'],
            $minLogLevel ?? $this->settings['level']
        );
        $logRotationHandler->setFilenameFormat("{date}-{$logName}.log", RotatingFileHandler::FILE_PER_DAY);
        $log->pushHandler($logRotationHandler);
        if ($toConsole || $this->logToConsole) {
            $minLogLevel = $this->getLogLevelByEnvironmentVerbosity();
            $log->pushHandler( /** @phpstan-ignore-next-line */
                new StreamHandler('php://stdout', $minLogLevel ?? $this->settings['level'])
            );
        }
        if ($this->settings['logServerEnabled']) {
            $log->pushHandler(
                new GelfHandler(
                    publisher:  new GelfPublisher(
                        new UdpTransport(
                            $this->settings['logServerHost'],
                            $this->settings['logServerPort']
                        )
                    ),
                    level: $this->settings['logServerLevel'] ?? $this->settings['level']
                )
            );
        }
        // Processes a log record's message according to PSR-3 rules, replacing {foo} with the value from
        $log->pushProcessor(new PsrLogMessageProcessor())
            // Adds the line/file/class/method from which the log call originated to the extra record.
        //    ->pushProcessor(new IntrospectionProcessor())
            // Adds the process id to a log record.
            ->pushProcessor(new ProcessIdProcessor());
        // Adds the current hostname to a log record.
        // $log->pushProcessor(new HostnameProcessor())
        // Adds a unique identifier to a log record.
        // $log->pushProcessor(new UidProcessor());

        return $log;
    }

    /**
     * Return logger with default settings.
     * this function only exists to make it explicit though naming.
     * @return Logger
     */
    public function getDefaultLogger(): Logger
    {
        return $this->getRotatingFileLogger(null);
    }

    /**
     * Return logger with default settings.
     * this function only exists to make it explicit though naming.
     * @param int|null $logLevel
     * @return Logger
     */
    public function getConsoleLogger(?int $logLevel = null): Logger
    {
        return $this->getRotatingFileLogger(null, null, $logLevel, true);
    }

    /**
     * @see: app/bootstrap.php
     * @return int
     */
    public static function getLogLevelByEnvironmentVerbosity(): int
    {
        switch ($_ENV['SHELL_VERBOSITY'] ?? $_SERVER['SHELL_VERBOSITY'] ?? (int) getenv('SHELL_VERBOSITY')) {
            case -1:
                $result = Logger::CRITICAL;
                break;
            case 0:
            default:
                $result = Logger::ERROR;
                break;
            case 1:
                $result = Logger::WARNING;
                break;
            case 2:
                $result = Logger::INFO;
                break;
            case 3:
                $result = Logger::DEBUG;
                break;
        }

        return $result;
    }
}
