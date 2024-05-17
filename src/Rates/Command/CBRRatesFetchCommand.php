<?php

namespace App\Rates\Command;

use App\Infrastructure\CurrencyClient\ExternalCurrencyClient;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'rates:cbr_fetch',
    description: 'Fetch rates from CBR',
)]
class CBRRatesFetchCommand extends Command
{
    public function __construct(private readonly ExternalCurrencyClient $client)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->addArgument('date', InputArgument::OPTIONAL, 'date');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $date = new \DateTimeImmutable($input->getArgument('date') ?? 'now');

        var_dump($this->client->getRateByDate($date));

        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }
}
