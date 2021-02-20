<?php

namespace App\Entity;

use App\Repository\HumanRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JsonSerializable;

/**
 * @ORM\Entity(repositoryClass=HumanRepository::class)
 */
class Human implements JsonSerializable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $sex;

    /**
     * @ORM\ManyToOne(targetEntity="Human")
     * @ORM\JoinColumn(name="father_id", referencedColumnName="id")
     */
    private ?Human $father;

    /**
     * @ORM\ManyToOne(targetEntity="Human")
     * @ORM\JoinColumn(name="mother_id", referencedColumnName="id")
     */
    private ?Human $mother;

    /**
     * @ORM\ManyToOne(targetEntity="Generation", inversedBy="humans")
     * @ORM\JoinColumn(name="generation_id", referencedColumnName="id")
     */
    private Generation $generation;

    public function __construct(string $sex, ?Human $father = null, ?Human $mather = null)
    {
        $this->sex = $sex;
        $this->father = $father;
        $this->mother = $mather;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSex(): ?string
    {
        return $this->sex;
    }

    public function setSex(string $sex): self
    {
        $this->sex = $sex;

        return $this;
    }

    /**
     * @param Human $father
     * @return self
     */
    public function setFather(Human $father): self
    {
        $this->father = $father;

        return $this;
    }

    /**
     * @return Human|null
     */
    public function getFather(): ?Human
    {
        return $this->father;
    }

    /**
     * @param Human $mother
     * @return self
     */
    public function setMother(Human $mother): self
    {
        $this->mother = $mother;

        return $this;
    }

    /**
     * @return Human|null
     */
    public function getMother(): ?Human
    {
        return $this->mother;
    }

    public function getGeneration(): Generation
    {
        return $this->generation;
    }

    public function setGeneration(Generation $generation): self
    {
        $this->generation = $generation;

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            $this->id,
            $this->sex,
            $this->father ? $this->father->getId() : '',
            $this->mother ? $this->mother->getId() : '',
        ];
    }
}
