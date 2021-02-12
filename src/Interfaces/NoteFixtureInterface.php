<?php


namespace App\Interfaces;


use Doctrine\Persistence\ObjectManager;

interface NoteFixtureInterface
{


    public function fixtureNote(ObjectManager $manager );

}