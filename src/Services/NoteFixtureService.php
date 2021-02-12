<?php

namespace App\Services;

use App\Entity\Eleve;
use App\Entity\Note;
use App\Interfaces\NoteFixtureInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;


class NoteFixtureService implements NoteFixtureInterface
{
    private const NOTE_FIXTURE = [
        [
            'valeur' => 10.25,
            'matiere' => 'POO',
            'eleve' => 1,
        ],
        [
            'valeur' => 3.75,
            'matiere' => 'POO',
            'eleve' => 2,
        ],
        [
            'valeur' => 20,
            'matiere' => 'POO',
            'eleve' => 3,
        ],
        [
            'valeur' => 15,
            'matiere' => 'Angular 11',
            'eleve' => 1,
        ],
        [
            'valeur' => 5,
            'matiere' => 'Angular 11',
            'eleve' => 2,
        ],
        [
            'valeur' => 12,
            'matiere' => 'Angular 11',
            'eleve' => 3,
        ],
        [
            'valeur' => 8,
            'matiere' => 'JAVA',
            'eleve' => 1,
        ],
        [
            'valeur' => 19,
            'matiere' => 'JAVA',
            'eleve' => 2,
        ],
        [
            'valeur' => 16,
            'matiere' => 'JAVA',
            'eleve' => 3,
        ],

    ];

    private $em;


    public function __construct(EntityManagerInterface $em  )
    {
        $this->em = $em;


    }



    public function fixtureNote( ObjectManager $manager ) :void
    {

        foreach (self::NOTE_FIXTURE as $noteFixture)
        {
            $note =new Note();
            $note->setValeur($noteFixture['valeur'])
                ->setMatiere($noteFixture['matiere'])
                ->setEleve($this->em
                            ->getRepository(Eleve::class)
                            ->find($noteFixture['eleve']));
            $this->em->persist($note);
        }
        $this->em->flush();
    }
}