<?php

namespace App\Command;

use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Contracts\HttpClient\Exception\HttpExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class TestSleepCommand extends Command
{
    protected static $defaultName = 'app:reproducer';

    private $httpClient;
    private $logger;

    public function __construct(HttpClientInterface $httpClient, LoggerInterface $logger)
    {
        parent::__construct();

        $this->httpClient = $httpClient;
        $this->logger = $logger;
    }

    protected function configure()
    {
        $this
            ->setDescription('Reproducer for 34289')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // Does not log response content
        try {
            $this->httpClient->request('GET', 'https://127.0.0.1:8000/sleep/1/throw');
        } catch (HttpExceptionInterface $exception) {
            $this->logger->error('Request with response content unfetched', ['exception' => $exception]);
        }

        // OK: It logs response content
        try {
            $this->httpClient->request('GET', 'https://127.0.0.1:8000/sleep/1/throw')
                ->getContent();
        } catch (HttpExceptionInterface $exception) {
            $this->logger->error('Request with response content fetched', ['exception' => $exception]);
        }

        // Does not log response content
        try {
            $this->httpClient->request('GET', 'https://127.0.0.1:8000/sleep/1/throw');
        } finally {
        }

        return 0;
    }
}
