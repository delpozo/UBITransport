<?php

namespace App\Services;

use App\Entity\Eleve;
use App\Interfaces\EleveFixtureInterface;
use Doctrine\ORM\EntityManagerInterface;

class EleveFixtureService implements EleveFixtureInterface
{
    private const ELEVE_FIXTURE = [
        [
            'nom' => "Jeams",
            'prenom' => 'Boond',
            'dateDeNaissance' => '1991-12-22',
        ],
        [
            'nom' => "Joe",
            'prenom' => 'Boy',
            'dateDeNaissance' => '1991-11-20',
        ],
        [
            'nom' => "Joe",
            'prenom' => 'Doo',
            'dateDeNaissance' => '1991-02-2',
        ],
        [
            'nom' => "Aza",
            'prenom' => 'Co',
            'dateDeNaissance' => '1997-10-10',
        ],
        [
            'nom' => 5,
            'prenom' => 'Angular 11',
            'dateDeNaissance' => '1996-08-10',
        ],
    ];

    private $em;

    public function __construct(EntityManagerInterface $em )
    {
        $this->em = $em;

    }



    public function fixtureEleve() :void
    {

        foreach (self::ELEVE_FIXTURE as $eleveFixture)
        {
            $eleve =new Eleve();
            $eleve->setNom($eleveFixture['nom'])
                ->setPrenom($eleveFixture['prenom'])
                ->setDateDeNaissance(new \DateTime($eleveFixture['dateDeNaissance']))
                ->setCreatedAt(new \DateTime('now'))
                ->setUpdatedAt(new \DateTime('now'))
                ->setIsDeleted(false);
            $this->em->persist($eleve);

        }
        $this->em->flush();
    }
}