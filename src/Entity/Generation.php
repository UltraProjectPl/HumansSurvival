<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Sortable\Entity\Repository\SortableRepository;

/**
 * @ORM\Entity(repositoryClass=SortableRepository::class)
 */
class Generation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @Gedmo\SortablePosition
     * @ORM\Column(type="integer")
     */
    private int $generation;

    /**
     * @ORM\OneToMany(targetEntity="Human", mappedBy="generation")
     */
    private Collection $humans;

    public function __construct()
    {
        $this->humans = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGeneration(): ?int
    {
        return $this->generation;
    }

    public function setGeneration(int $generation): self
    {
        $this->generation = $generation;

        return $this;
    }

    public function getHumans(): Collection
    {
        return $this->humans;
    }

    public function addHuman(Human $human): self
    {
        $this->humans->add($human);

        return $this;
    }
}
