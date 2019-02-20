<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticlesRepository")
 */
class Articles
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
     * @ORM\Column(type="string", length=600)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Categories", inversedBy="containsArticles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $refCategories_fk;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCreate;


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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getRefCategoriesFk(): ?Categories
    {
        return $this->refCategories_fk;
    }

    public function setRefCategoriesFk(?Categories $refCategories_fk): self
    {
        $this->refCategories_fk = $refCategories_fk;

        return $this;
    }

    public function getDateCreate(): ?\DateTimeInterface
    {
        return $this->dateCreate;
    }

    public function setDateCreate(\DateTimeInterface $dateCreate): self
    {
        $this->dateCreate = $dateCreate;

        return $this;
    }
}
