<?php

namespace App\Repository;

use App\Entity\Human;
use App\SexEnum;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Human|null find($id, $lockMode = null, $lockVersion = null)
 * @method Human|null findOneBy(array $criteria, array $orderBy = null)
 * @method Human[]    findAll()
 * @method Human[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HumanRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Human::class);
    }

    public function findAllFathers(): array
    {
        return $this->findBy(['sex' => SexEnum::MAN]);
    }

    public function findAllMothers(): array
    {
        return $this->findBy(['sex' => SexEnum::WOMAN]);
    }

    public function findAllByGraph(): array
    {
        $q = $this->createQueryBuilder('q')
            ->find
    }
}
