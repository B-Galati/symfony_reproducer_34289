<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class TestSleepCommand extends Command
{
    protected static $defaultName = 'app:test-sleep';

    private $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        parent::__construct();

        $this->httpClient = $httpClient;
    }

    protected function configure()
    {
        $this
            ->setDescription('Add a short description for your command')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $responses = [];

        $io->text('5s');
        $responses[] = $this->httpClient->request('GET', 'https://127.0.0.1:8000/sleep/5');

        $io->text('1s');
        $responses[] = $this->httpClient->request('GET', 'https://127.0.0.1:8000/sleep/1');

        $io->text('1s throw');
        $responses[] = $this->httpClient->request('GET', 'https://127.0.0.1:8000/sleep/1/throw');

        $io->text('1s');
        $responses[] = $this->httpClient->request('GET', 'https://127.0.0.1:8000/sleep/1');

        unset($responses);

        $io->text('DONE');

        return 0;
    }
}
