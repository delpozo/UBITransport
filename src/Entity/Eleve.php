<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\EleveRepository;
use App\Traits\TimestampTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Controller\NoteController;
use App\Controller\ClasseController;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Annotation\ApiFilter;



/**
 * @ApiResource(
 *     itemOperations={
 *         "get"={
 *             "normalization_context"={
 *                "groups"={"get-eleve"}
 *             }
 *         },
 *         "put"={
 *             "normalization_context"={
 *                "groups"={"get-eleve"}
 *             },
 *             "denormalization_context"={
 *                "groups"={"put-eleve"}
 *             }
 *         },
 *         "delete"={
 *             "denormalization_context"={
 *                "groups"={"delete-eleve"}
 *             }
 *         },
 *         "moyenne-eleve"={
 *             "method"="GET",
 *             "path"="/eleves/{id}/moyenne",
 *             "controller"=NoteController::class
 *         }
 *     },
 *     collectionOperations={
 *         "get"={
 *             "normalization_context"={
 *                "groups"={"get-all-eleve"}
 *             }
 *         },
 *         "moyenne-classe"={
 *             "method"="GET",
 *             "path"="/eleves/moyenne",
 *             "controller"=ClasseController::class
 *         },
 *         "post"={
 *             "normalization_context"={
 *                "groups"={"post-eleve"}
 *             },
 *             "denormalization_context"={
 *                "groups"={"post-eleve"}
 *             }
 *         }
 *     },
 * )
 * @ApiFilter(SearchFilter::class,
 *     properties={"isDeleted": "exact", "id": "exact" ,"nom" :"exact"})
 * @ApiFilter(OrderFilter::class,
 *     properties={ "createdAt" :"DEST"},
 *     arguments={"orderParameterName"="order"})
 * @ORM\Entity(repositoryClass=EleveRepository::class)
 */
class Eleve
{
    use TimestampTrait;
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"get-eleve","get-all-eleve", "get-all-note"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=60)
     * @Groups({"get-eleve", "get-all-eleve", "post-eleve", "put-eleve", "get-all-note", "get-all-note"})
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=60)
     * @Groups({"get-eleve", "get-all-eleve", "post-eleve", "put-eleve", "get-all-note", "get-all-note"})
     */
    private $prenom;

    /**
     * @ORM\Column(type="date")
     * @Groups({"get-eleve", "get-all-eleve", "post-eleve", "put-eleve"})
     */
    private $dateDeNaissance;

    /**
     * @ORM\OneToMany(targetEntity=Note::class, mappedBy="eleve", orphanRemoval=true)
     */
    private $notes;

    public function __construct()
    {
        $this->notes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getDateDeNaissance(): ?\DateTimeInterface
    {
        return $this->dateDeNaissance;
    }

    public function setDateDeNaissance(\DateTimeInterface $dateDeNaissance): self
    {
        $this->dateDeNaissance = $dateDeNaissance;

        return $this;
    }

    /**
     * @return Collection|Note[]
     */
    public function getNotes(): Collection
    {
        return $this->notes;
    }

    public function addNote(Note $note): self
    {
        if (!$this->notes->contains($note)) {
            $this->notes[] = $note;
            $note->setEleve($this);
        }

        return $this;
    }

    public function removeNote(Note $note): self
    {
        if ($this->notes->removeElement($note)) {
            // set the owning side to null (unless already changed)
            if ($note->getEleve() === $this) {
                $note->setEleve(null);
            }
        }

        return $this;
    }

    public function __toString():string
    {
        // TODO: Implement __toString() method.
        return $this->getNom()." ".$this->getPrenom();
    }

}
