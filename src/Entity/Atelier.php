<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Atelier
 *
 * @ORM\Table(name="atelier")
 * @ORM\Entity
 * @ApiResource()
 */
class Atelier
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Groups("commentaire")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="text", length=65535, nullable=false)
     * @Groups("commentaire")
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="text", length=65535, nullable=false)
     * @Groups("commentaire")
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="uniteDePerformance", type="text", length=65535, nullable=false)
     * @Groups("commentaire")
     */
    private $unitedeperformance;

    /**
     * @var string
     *
     * @ORM\Column(name="uniteDIntensite", type="text", length=65535, nullable=false)
     * @Groups("commentaire")
     */
    private $unitedintensite;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=false)
     * @Groups("commentaire")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="resume", type="text", length=65535, nullable=false)
     * @Groups("commentaire")
     */
    private $resume;

    /**
     * @ORM\OneToMany(targetEntity=CommentaireAtelier::class, mappedBy="atelier")
     * @Groups("commentaire")
     */
    private $commentaires;

    public function __construct()
    {
        $this->commentaires = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getUnitedeperformance(): ?string
    {
        return $this->unitedeperformance;
    }

    public function setUnitedeperformance(string $unitedeperformance): self
    {
        $this->unitedeperformance = $unitedeperformance;

        return $this;
    }

    public function getUnitedintensite(): ?string
    {
        return $this->unitedintensite;
    }

    public function setUnitedintensite(string $unitedintensite): self
    {
        $this->unitedintensite = $unitedintensite;

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

    public function getResume(): ?string
    {
        return $this->resume;
    }

    public function setResume(string $resume): self
    {
        $this->resume = $resume;

        return $this;
    }

    /**
     * @return Collection|CommentaireAtelier[]
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(CommentaireAtelier $commentaire): self
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires[] = $commentaire;
            $commentaire->setAtelier($this);
        }

        return $this;
    }

    public function removeCommentaire(CommentaireAtelier $commentaire): self
    {
        if ($this->commentaires->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getAtelier() === $this) {
                $commentaire->setAtelier(null);
            }
        }

        return $this;
    }


}
