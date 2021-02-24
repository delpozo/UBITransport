<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\NoteRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Annotation\ApiFilter;
use App\Traits\TimestampTrait;
/**
 * @ApiResource(
 *     itemOperations={
 *         "get"={
 *             "normalization_context"={
 *                "groups"={"get-note"}
 *             }
 *         },
 *         "put"={
 *             "normalization_context"={
 *                "groups"={"get-note"}
 *             },
 *             "denormalization_context"={
 *                "groups"={"put-note"}
 *             }
 *         },
 *         "delete"={
 *             "denormalization_context"={
 *                "groups"={"delete-note"}
 *             }
 *         }
 *     },
 *     collectionOperations={
 *         "get"={
 *             "normalization_context"={
 *                "groups"={"get-all-note"}
 *             }
 *         },
 *         "post"={
 *             "normalization_context"={
 *                "groups"={"get-all-note"}
 *             },
 *             "denormalization_context"={
 *                "groups"={"post-note"}
 *             }
 *         }
 *     },
 * )
 * * @ApiFilter(SearchFilter::class,
 *     properties={"isDeleted": "exact", "id": "exact" , "matiere":"partial"})
 * @ApiFilter(OrderFilter::class,
 *     properties={ "createdAt"},
 *     arguments={"orderParameterName"="order"})
 * @ORM\Entity(repositoryClass=NoteRepository::class)
 */
class Note
{
    use TimestampTrait;
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"get-note", "get-all-note", "post-note", "put-note"})
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(
     *      min = 0,
     *      max = 20,
     *      minMessage = "Note entre 0 et 20",
     *      maxMessage = "Note entre 0 et 20"
     * )
     * @Groups({"get-note", "get-all-note", "post-note", "put-note"})
     */
    private $valeur;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"get-note", "get-all-note", "post-note", "put-note"})
     */
    private $matiere;

    /**
     * @ORM\ManyToOne(targetEntity=Eleve::class, inversedBy="notes")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"post-note", "get-all-note"})
     */
    private $eleve;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValeur(): ?int
    {
        return $this->valeur;
    }

    public function setValeur(int $valeur): self
    {
        $this->valeur = $valeur;

        return $this;
    }

    public function getMatiere(): ?string
    {
        return $this->matiere;
    }

    public function setMatiere(string $matiere): self
    {
        $this->matiere = $matiere;

        return $this;
    }

    public function getEleve(): ?Eleve
    {
        return $this->eleve;
    }

    public function setEleve(?Eleve $eleve): self
    {
        $this->eleve = $eleve;

        return $this;
    }
}
