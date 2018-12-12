<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoriesRepository")
 */
class Categories
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Articles", mappedBy="refCategories_fk", orphanRemoval=true)
     */
    private $containsArticles;

    public function __construct()
    {
        $this->containsArticles = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Articles[]
     */
    public function getContainsArticles(): Collection
    {
        return $this->containsArticles;
    }

    public function addContainsArticle(Articles $containsArticle): self
    {
        if (!$this->containsArticles->contains($containsArticle)) {
            $this->containsArticles[] = $containsArticle;
            $containsArticle->setRefCategoriesFk($this);
        }

        return $this;
    }

    public function removeContainsArticle(Articles $containsArticle): self
    {
        if ($this->containsArticles->contains($containsArticle)) {
            $this->containsArticles->removeElement($containsArticle);
            // set the owning side to null (unless already changed)
            if ($containsArticle->getRefCategoriesFk() === $this) {
                $containsArticle->setRefCategoriesFk(null);
            }
        }

        return $this;
    }
}
