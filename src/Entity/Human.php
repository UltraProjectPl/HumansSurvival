<?php

namespace App\Entity;

use App\Repository\HumanRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HumanRepository::class)
 */
class Human
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
     * @ORM\JoinColumn(name="mather_id", referencedColumnName="id")
     */
    private ?Human $mather;

    public function __construct(string $sex, ?Human $father = null, ?Human $mather = null)
    {
        $this->sex = $sex;
        $this->father = $father;
        $this->mather = $mather;
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
     * @return Human
     */
    public function getFather(): Human
    {
        return $this->father;
    }

    /**
     * @param Human $mather
     * @return self
     */
    public function setMather(Human $mather): self
    {
        $this->mather = $mather;

        return $this;
    }

    /**
     * @return Human
     */
    public function getMather(): Human
    {
        return $this->mather;
    }
}
