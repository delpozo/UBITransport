<?php

namespace App\DataFixtures;


use App\Services\EleveFixtureService;
use App\Services\NoteFixtureService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Console\Application;


class AppFixtures extends Fixture
{
    private $noteService;
    private $eleveService;

    public function __construct(
        NoteFixtureService $noteService ,
        EleveFixtureService $eleveService
    )
    {
        $this->noteService = $noteService;
        $this->eleveService =$eleveService;
    }
    public function load(ObjectManager $manager)
    {
        $this->eleveService->fixtureEleve();
        $this->noteService->fixtureNote($manager);

    }
}
