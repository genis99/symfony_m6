<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CanalRepository")
 */
class Canal
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Missatge", mappedBy="canal", orphanRemoval=true)
     */
    private $missatges;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Categoria", mappedBy="canal")
     */
    private $categories;

    public function __construct()
    {
        $this->missatges = new ArrayCollection();
        $this->categories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection|Missatge[]
     */
    public function getMissatges(): Collection
    {
        return $this->missatges;
    }

    public function addMissatge(Missatge $missatge): self
    {
        if (!$this->missatges->contains($missatge)) {
            $this->missatges[] = $missatge;
            $missatge->setCanal($this);
        }

        return $this;
    }

    public function removeMissatge(Missatge $missatge): self
    {
        if ($this->missatges->contains($missatge)) {
            $this->missatges->removeElement($missatge);
            // set the owning side to null (unless already changed)
            if ($missatge->getCanal() === $this) {
                $missatge->setCanal(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Categoria[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Categoria $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
            $category->addCanal($this);
        }

        return $this;
    }

    public function removeCategory(Categoria $category): self
    {
        if ($this->categories->contains($category)) {
            $this->categories->removeElement($category);
            $category->removeCanal($this);
        }

        return $this;
    }
}
