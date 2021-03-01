<?php

namespace App\Controller;

use App\Services\NoteService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class ClasseController extends AbstractController
{

    /**
     * @var NoteService
     */
    private $noteService;

    public function __construct(NoteService $noteService)
    {
        $this->noteService = $noteService;
    }

    public function __invoke($data): JsonResponse
    {
        $resultat = [
            'moyenne' =>  $this->noteService->calculMoyenneParClasse($data)
        ];
        return new JsonResponse($resultat);
    }
}
