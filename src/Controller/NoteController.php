<?php

namespace App\Controller;

use App\Entity\Eleve;
use App\Services\NoteService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class NoteController extends AbstractController
{

    /**
     * @var NoteService
     */
    private $noteService;

    public function __construct(NoteService $noteService)
    {
        $this->noteService = $noteService;
    }

    public function __invoke(Eleve $data): JsonResponse
    {
        //$notes = array_sum((array)$data->getNotes())/count((array)$data->getNotes());

        $resultat = [
            'id' => $data->getId(),
            'nom' => $data->getNom(),
            'prenom' => $data->getPrenom(),
            'moyenne' => 0
        ];

        $resultat['moyenne'] = $this->noteService->calculMoyenneParEleve($data);

        return new JsonResponse($resultat);
    }
}
