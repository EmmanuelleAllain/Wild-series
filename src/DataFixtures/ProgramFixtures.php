<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    public const PROGRAMS = [
        ['title' => 'Peppa Pig', 'synopsis' => 'Peppa vit avec son frère Georges et ses parents dans une maison sur la colline.', 'category' => 'Animation'],
        ['title' => 'Desperate Housewives', 'synopsis' => 'C\'est l\'histoire de dames qui s\'ennuient dans leur maison.', 'category' => 'Aventure'],
        ['title' => 'Peaky Blinders', 'synopsis' => 'C\'est l\'histoire d\'un monsieur, un peu fou mais sympa dans le fond, et de ses frères qui l\aident à réaliser ses rêves', 'category' => 'Action'],
        ['title' => 'How I met your mother', 'synopsis' => 'Ted raconte à ses enfants comment il a rencontré sa femme, et ça lui prend 9 saisons.', 'category' => 'Humour'],
        ['title' => 'Breaking Bad', 'synopsis' => 'Un père de famille sympa à la base se lance dans le commerce de drogue et devient un peu moins sympa.', 'category' => 'Action'],
    ];
 
    public function load(ObjectManager $manager): void
    {
        foreach (self::PROGRAMS as $key => $programName)
        $program = new Program();
        $program
            ->setTitle($programName['title'])
            ->setSynopsis($programName['synopsis'])
            ->setCategory($this->getReference('category_' . $programName['category']));
        $this->addReference('program_' . $key, $program);
        $manager->persist($program);

        $manager->flush();
    }
    public function getDependencies()
    {
        return [
          CategoryFixtures::class,
        ];
    }
}
