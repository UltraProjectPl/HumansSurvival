<?php

namespace App\Command;

use App\Entity\Generation;
use App\Entity\Human;
use App\Repository\GenerationRepository;
use App\SexEnum;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class HumanAddFirstParentCommand extends Command
{
    protected static $defaultName = 'human:add-first-parent';
    protected static $defaultDescription = 'Add first parents';

    private EntityManagerInterface $entityManager;
    private GenerationRepository $generationRepository;

    public function __construct(string $name = null, EntityManagerInterface $entityManager, GenerationRepository $generationRepository)
    {
        parent::__construct($name);
        $this->entityManager = $entityManager;
        $this->generationRepository = $generationRepository;
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

        $generation = new Generation();
        $this->entityManager->persist($generation);

        for ($i = 0; $i < $fathers; $i++) {
            $human = new Human(SexEnum::MAN);
            $human->setGeneration($generation);
            $this->entityManager->persist($human);
        }

        for ($i = 0; $i < $mothers; $i++) {
            $human = new Human(SexEnum::WOMAN);
            $human->setGeneration($generation);
            $this->entityManager->persist($human);
        }

        $this->entityManager->flush();

        $io->success('Added first parents.');

        return Command::SUCCESS;
    }
}
