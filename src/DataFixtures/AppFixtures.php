<?php

namespace App\DataFixtures;

use App\Entity\Generation;
use App\Entity\Human;
use App\SexEnum;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $this->loadExampleFamily($manager);
        $manager->flush();
    }

    public function loadExampleFamily(ObjectManager $manager): void
    {
        $generation = new Generation();
        $manager->persist($generation);

        $father1 = new Human(SexEnum::MAN);
        $father1->setGeneration($generation);
        $father2 = new Human(SexEnum::MAN);
        $father2->setGeneration($generation);

        $mother1 = new Human(SexEnum::WOMAN);
        $mother1->setGeneration($generation);
        $mother2 = new Human(SexEnum::WOMAN);
        $mother2->setGeneration($generation);

        $manager->persist($mother1);
        $manager->persist($mother2);
        $manager->persist($father1);
        $manager->persist($father2);

        $generation = new Generation();
        $manager->persist($generation);

        $child1_11 = new Human(SexEnum::MAN, $father1, $mother1);
        $child1_11->setGeneration($generation);
        $child2_11 = new Human(SexEnum::WOMAN, $father1, $mother1);
        $child2_11->setGeneration($generation);

        $child1_12 = new Human(SexEnum::MAN, $father1, $mother2);
        $child1_12->setGeneration($generation);
        $child2_12 = new Human(SexEnum::WOMAN, $father1, $mother2);
        $child2_12->setGeneration($generation);

        $child1_21 = new Human(SexEnum::MAN, $father2, $mother1);
        $child1_21->setGeneration($generation);
        $child2_21 = new Human(SexEnum::WOMAN, $father2, $mother1);
        $child2_21->setGeneration($generation);

        $child1_22 = new Human(SexEnum::MAN, $father2, $mother2);
        $child1_22->setGeneration($generation);
        $child2_22 = new Human(SexEnum::WOMAN, $father2, $mother2);
        $child2_22->setGeneration($generation);

        $manager->persist($child1_11);
        $manager->persist($child2_11);
        $manager->persist($child1_12);
        $manager->persist($child2_12);
        $manager->persist($child1_21);
        $manager->persist($child2_21);
        $manager->persist($child1_22);
        $manager->persist($child2_22);

        $generation = new Generation();
        $manager->persist($generation);

        $child1_11_22 = new Human(SexEnum::MAN, $child1_11, $child2_22);
        $child1_11_22->setGeneration($generation);
        $child2_11_22 = new Human(SexEnum::WOMAN, $child1_22, $child2_11);
        $child2_11_22->setGeneration($generation);

        $child1_12_21 = new Human(SexEnum::MAN, $child1_12, $child2_21);
        $child1_12_21->setGeneration($generation);
        $child2_12_21 = new Human(SexEnum::WOMAN, $child1_21, $child2_12);
        $child2_12_21->setGeneration($generation);

        $manager->persist($child1_11_22);
        $manager->persist($child2_11_22);
        $manager->persist($child1_12_21);
        $manager->persist($child2_12_21);

        $generation = new Generation();
        $manager->persist($generation);

        $child_11_22_12_21 = new Human(SexEnum::MAN, $child1_11_22, $child2_12_21);
        $child_11_22_12_21->setGeneration($generation);
        $child_12_21_12_21 = new Human(SexEnum::WOMAN, $child1_12_21, $child2_12_21);
        $child_12_21_12_21->setGeneration($generation);

        $manager->persist($child_11_22_12_21);
        $manager->persist($child_12_21_12_21);
    }
}
