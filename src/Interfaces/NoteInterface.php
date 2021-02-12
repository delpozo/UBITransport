<?php


namespace App\Interfaces;

use App\Entity\Eleve;

interface NoteInterface
{
    public function calculMoyenneParEleve(Eleve $eleve);

    public function calculMoyenneParClasse($eleves);


}