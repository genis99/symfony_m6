<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoriaRepository")
 * @Table(name="categoria",uniqueConstraints={@UniqueConstraint(name="search_idx", columns={"name"})})
 */
class Categoria
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Canal", inversedBy="categories")
     */
    private $canal;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    public function __construct()
    {
        $this->canal = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Canal[]
     */
    public function getCanal(): Collection
    {
        return $this->canal;
    }

    public function addCanal(Canal $canal): self
    {
        if (!$this->canal->contains($canal)) {
            $this->canal[] = $canal;
        }

        return $this;
    }

    public function removeCanal(Canal $canal): self
    {
        if ($this->canal->contains($canal)) {
            $this->canal->removeElement($canal);
        }

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
