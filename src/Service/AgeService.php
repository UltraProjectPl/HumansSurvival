<?php

namespace App\Service;

use App\Entity\Human;
use App\Repository\HumanRepository;
use App\SexEnum;
use Doctrine\ORM\EntityManagerInterface;

class AgeService
{
    private HumanRepository $humanRepository;
    private EntityManagerInterface $entityManager;

    public function __construct(HumanRepository $humanRepository, EntityManagerInterface $entityManager)
    {
        $this->humanRepository = $humanRepository;
        $this->entityManager = $entityManager;
    }

    public function reproduction(): void
    {
        $allFathers = $this->humanRepository->findAllFathers();
        $allMothers = $this->humanRepository->findAllMothers();

        foreach ($allFathers as $father) {
            foreach ($allMothers as $motherKey => $mother) {
                $sex = random_int(0, 1) === 0 ? SexEnum::WOMAN : SexEnum::MAN;
                $child = new Human($sex, $father, $mother);
                $this->entityManager->persist($child);
            }
        }

        $this->entityManager->flush();
    }
}