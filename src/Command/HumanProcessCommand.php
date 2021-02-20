<?php

namespace App\Command;

use App\Service\AgeService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class HumanProcessCommand extends Command
{
    protected static $defaultName = 'human:process';
    protected static $defaultDescription = 'Add a short description for your command';

    private AgeService $ageService;

    public function __construct(string $name = null, AgeService $ageService)
    {
        parent::__construct($name);
        $this->ageService = $ageService;
    }

    protected function configure()
    {
        $this
            ->setDescription(self::$defaultDescription)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->ageService->reproduction();
        return Command::SUCCESS;
    }
}
