<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Utility\ContainerFactory;
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Yaml\Yaml;

/**
 * Silence warning while correcting shitty php internal interface
 */
if (PHP_MAJOR_VERSION >= 7) {
    set_error_handler(function ($errno, $errstr, $file) {
        return strpos($file, 'LoggingSoapClient') !== false &&
            strpos($errstr, 'Declaration of') === 0;
    }, E_WARNING);
}

// Set up settings
// This has to always be the first step because the other steps depend on config
$settings = Yaml::parseFile(__DIR__ . '/../config/config.yaml');

// Activate console logging if neccessary
ContainerFactory::setLogToConsole($logToConsole ?? false);

// @see: Symfony\Component\Console\Application::run()
if ($logToConsole ?? false) {
    $input = new ArgvInput();
    $shellVerbosity = (int)getenv('SHELL_VERBOSITY');
    if (true === $input->hasParameterOption(['--quiet', '-q'], true)) {
        $shellVerbosity = -1;
    } else {
        if ($input->hasParameterOption('-vvv', true)
            || $input->hasParameterOption('--verbose=3', true)
            || 3 === $input->getParameterOption('--verbose', false, true)) {
            $shellVerbosity = 3;
        } elseif ($input->hasParameterOption('-vv', true)
            || $input->hasParameterOption('--verbose=2', true)
            || 2 === $input->getParameterOption('--verbose', false, true)) {
            $shellVerbosity = 2;
        } elseif ($input->hasParameterOption('-v', true)
            || $input->hasParameterOption('--verbose=1', true)
            || $input->hasParameterOption('--verbose', true)
            || $input->getParameterOption('--verbose', false, true)) {
            $shellVerbosity = 1;
        }
    }

    if (function_exists('putenv')) {
        @putenv('SHELL_VERBOSITY=' . $shellVerbosity);
    }
    $_ENV['SHELL_VERBOSITY'] = $shellVerbosity;
    $_SERVER['SHELL_VERBOSITY'] = $shellVerbosity;
}

// Create container
$container = ContainerFactory::fromSettings($settings);
return $container;
