<?php

namespace App\Console;

use PBergman\Console\Helper\TreeHelper;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Throwable;

/**
 * Just collect some generally useful methods to use in our Command classes
 */
abstract class BaseCommand extends Command
{
    protected ContainerInterface $container;
    protected InputInterface $input;
    protected OutputInterface $output;

    /**
     * don't overwrite there should not be happening more in the constructor die to Command class quirks
     *
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        parent::__construct();
        $this->container = $container;
    }

    /**
     * @param  array $array
     * @param  array $badFields
     * @param  array $badValues
     * @return void
     */
    protected static function recursiveMultiUnset(array &$array, array $badFields, array $badValues = [])
    {
        foreach ($badFields as $field) {
            unset($array[$field]);
        }
        foreach ($array as $key => &$value) {
            if (is_array($value)) {
                if (empty($value)) {
                    unset($array[$key]);
                }
                self::recursiveMultiUnset($value, $badFields, $badValues);
            } else {
                foreach ($badValues as $item) {
                    if ($value == $item) {
                        unset($array[$key]);
                    }
                }
            }
        }
    }

    /**
     * wrap execution part to structure command & facilitate convenience stuff
     * don't overwrite;
     *
     * @param                                         InputInterface  $input
     * @param                                         OutputInterface $output
     * @return                                        int
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $result = $this->perform();
        } catch (Throwable $exception) {
            // just make sure we are tearing down properly.
            $this->tearDown();
            throw $exception;
        }
        $this->tearDown();
        return $result;
    }

    /**
     * @param  InputInterface  $input
     * @param  OutputInterface $output
     * @return void
     */
    protected function initialize(InputInterface $input, OutputInterface $output): void
    {
        $this->input = $input;
        $this->output = $output;

        // extra flashy errors
        $this->output->getFormatter()->setStyle(
            'fire',
            new OutputFormatterStyle('red', 'yellow', ['bold', 'blink'])
        );

        $this->setUp();
    }

    /**
     * Initialize services here
     *
     * @return void
     */
    protected function setUp(): void
    {
        // Implement downstream
    }

    /**
     * implement command here now
     *
     * @return int
     */
    abstract protected function perform(): int;


    /**
     * optionally implement stuff to teardown process
     *
     * @return void
     */
    protected function tearDown(): void
    {
        // optionally implement
    }

    /**
     * colors command output through the write(ln) method
     *
     * @param  string $string
     * @return string
     */
    protected function errorTag(string $string): string
    {
        return '<error>' . $string . '</error>';
    }

    /**
     * colors command output through the write(ln) method
     *
     * @param  string $string
     * @return string
     */
    protected function infoTag(string $string): string
    {
        return '<info>' . $string . '</info>';
    }

    /**
     * colors command output through the write(ln) method
     *
     * @param  string $string
     * @return string
     */
    protected function commentTag(string $string): string
    {
        return '<comment>' . $string . '</comment>';
    }

    /**
     * colors command output through the write(ln) method
     *
     * @param  string $string
     * @return string
     */
    protected function questionTag(string $string): string
    {
        return '<question>' . $string . '</question>';
    }

    protected function fireTag(string $string): string
    {
        return '<fire>' . $string . '</fire>';
    }

    protected function error(string $string, int $verbosityLevel = OutputInterface::VERBOSITY_NORMAL): void
    {
        $this->output->writeln($this->errorTag($string), $verbosityLevel);
    }

    protected function info(string $string, int $verbosityLevel = OutputInterface::VERBOSITY_NORMAL): void
    {
        $this->output->writeln($this->infoTag($string), $verbosityLevel);
    }

    protected function comment(string $string, int $verbosityLevel = OutputInterface::VERBOSITY_NORMAL): void
    {
        $this->output->writeln($this->commentTag($string), $verbosityLevel);
    }

    protected function question(string $string, int $verbosityLevel = OutputInterface::VERBOSITY_NORMAL): void
    {
        $this->output->writeln($this->questionTag($string), $verbosityLevel);
    }

    protected function outLn(string $string, int $verbosityLevel = OutputInterface::VERBOSITY_NORMAL): void
    {
        $this->output->writeln($string, $verbosityLevel);
    }

    protected function fire(string $string, int $verbosityLevel = OutputInterface::VERBOSITY_NORMAL): void
    {
        $this->output->writeln($this->fireTag($string), $verbosityLevel);
    }

    /**
     * @param  mixed $data
     * @return void
     */
    protected function debug(mixed $data): void
    {
        $this->comment(var_export($data, true), OutputInterface::VERBOSITY_VERY_VERBOSE);
    }

    protected function table(?string $title, OutputInterface $output = null): Table
    {
        return (new Table($output ?? $this->output))->setHeaderTitle($title);
    }

    protected function tableFromArray(
        mixed $data,
        string $title = '',
        array $columnTitles = null,
        OutputInterface $output = null
    ): void {
        $data = is_array($data) ? $data : [(string) $data];
        $this->table($title, $output)
            ->setHeaders($columnTitles ?? array_keys($data))
            ->addRows($data)
            ->render();
    }

    protected function tableFromRowCallback(
        callable $callback,
        mixed $data,
        string $title = '',
        array $columnTitles = null,
    ): void {
        $data = is_array($data) ? $data : [(string) $data];
        $this->tableFromArray(
            array_map($callback, $data),
            $title,
            $columnTitles
        );
    }

    protected function startPogressBar(int $max): ProgressBar
    {
        $progressBar = new ProgressBar($this->output, $max);
        $progressBar->start();
        return $progressBar;
    }

    /**
     * real simple confirmation question considering verbosity settings
     *
     * @param  string      $question
     * @param  string|null $yesMsg
     * @param  string|null $noMsg
     * @return bool
     */
    protected function askConfirmation(
        string $question = 'Continue with this action? (y/N)',
        string $yesMsg = null,
        string $noMsg = null
    ): bool {
        $helper = $this->getHelper('question');
        $question = new ConfirmationQuestion(
            $this->questionTag($question),
            $this->output->isQuiet() || !$this->input->isInteractive()
        );
        $answer = (bool) $helper->ask($this->input, $this->output, $question);
        if ($answer && !is_null($yesMsg)) {
            $this->info($yesMsg);
        } elseif (!$answer && !is_null($noMsg)) {
            $this->info($noMsg);
        }
        return $answer;
    }

    /**
     * @param  ResponseInterface $response
     * @return void
     */
    protected function prettyPrintProblemPlusJson(ResponseInterface $response): void
    {
        $body = json_decode($response->getBody()->getContents());
        if (is_array($body)) {
            unset($body['links']);
            unset($body['extensions']);
            $tree = new TreeHelper();
            $tree->addArray($body);
            $tree->printTree($this->output);
        } else {
            $this->error("\n" . 'Unknown error');
        }
        // not sure what this was supposed to print..
        // $this->error("\n" . $buffer->fetch());
    }
}
