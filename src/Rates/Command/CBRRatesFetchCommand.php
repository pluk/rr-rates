<?php

namespace App\Rates\Command;

use App\Rates\Message\CBRRateFetch;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsCommand(
    name: 'rates:cbr_fetch',
    description: 'Fetch rates from CBR',
)]
class CBRRatesFetchCommand extends Command
{
    public function __construct(private readonly MessageBusInterface $messageBus)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->addArgument('days', InputArgument::OPTIONAL, 'days');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $days = $input->getArgument('days');
        $daysCount = $days !== null ? (int)  $days : 180;

        $date = new \DateTime();
        $this->dispatch($date->format('d/m/Y'), $io);

        for ($i = 1; $i < $daysCount; $i++) {
            $date->modify('-1 days');
            $dateString = $date->format('d/m/Y');

            $this->dispatch($dateString, $io);
        }

        return Command::SUCCESS;
    }

    private function dispatch(string $date, SymfonyStyle $io): void
    {
        $this->messageBus->dispatch(new CBRRateFetch($date));
        $io->writeln(sprintf('Message for date: %s added to queue', $date));
    }
}
