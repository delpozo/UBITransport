<?php

namespace App\Services;

use App\Entity\Eleve;
use App\Entity\Note;
use App\Interfaces\NoteInterface;
use Doctrine\ORM\EntityManagerInterface;

class NoteService implements NoteInterface
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    public function calculMoyenneParEleve(Eleve $eleve):float
    {
        $notes = 0;
        $matiere = 0;
        try {
            foreach ( $eleve->getNotes() as $note){
                $notes += $note->getValeur();
                ++$matiere;
            }
            //var_dump($notes / $matiere);
            //die();
            if ( $matiere === 0) return 0;
            return ($notes / $matiere);
        }
        catch (\Exception $exception){
            return 0;
        }
    }

    public function calculMoyenneParClasse($eleves):float
    {
        $moyenne = 0;
        $countEleves = 0;
        try {
            foreach ($eleves as $eleve){
                $moyenne += $this->calculMoyenneParEleve($eleve);
                ++$countEleves;
            }
            return ($moyenne / $countEleves);
        }catch (\Exception $exception){
            return 0;
        }
    }


}