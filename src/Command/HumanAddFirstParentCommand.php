<?php

namespace App\Command;

use App\Entity\Human;
use App\SexEnum;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class HumanAddFirstParentCommand extends Command
{
    private EntityManagerInterface $entityManager;

    protected static $defaultName = 'human:add-first-parent';
    protected static $defaultDescription = 'Add first parents';

    public function __construct(string $name = null, EntityManagerInterface $entityManager)
    {
        parent::__construct($name);
        $this->entityManager = $entityManager;
    }

    protected function configure()
    {
        $this
            ->setDescription(self::$defaultDescription)
            ->addArgument('fathers', InputArgument::REQUIRED, 'Number of first fathers')
            ->addArgument('mothers', InputArgument::REQUIRED, 'Number of first mothers')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $fathers = (int)$input->getArgument('fathers');
        $mothers = (int)$input->getArgument('mothers');

        for ($i = 0; $i < $fathers; $i++) {
            $human = new Human(SexEnum::MAN);
            $this->entityManager->persist($human);
        }

        for ($i = 0; $i < $mothers; $i++) {
            $human = new Human(SexEnum::WOMAN);
            $this->entityManager->persist($human);
        }

        $this->entityManager->flush();

        $io->success('Added first parents.');

        return Command::SUCCESS;
    }
}
