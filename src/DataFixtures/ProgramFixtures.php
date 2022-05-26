<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $program = new Program();
        $program
            ->setTitle('Peppa Pig')
            ->setSynopsis('Peppa vit avec son frère Georges et ses parents dans une maison sur la colline.')
            ->setCategory($this->getReference('category_Animation'));
        $manager->persist($program);

        $program1 = new Program();
        $program1->setTitle('Desperate Housewives');
        $program1->setSynopsis('C\'est l\'histoire de dames qui s\'ennuient dans leur maison.');
        $program1->setCategory($this->getReference('category_Action'));
        $manager->persist($program1);

        $program2 = new Program();
        $program2->setTitle('Peaky Blinders');
        $program2->setSynopsis('C\'est l\'histoire d\'un monsieur, un peu fou mais sympa dans le fond, et de ses frères qui l\aident à réaliser ses rêves');
        $program2->setCategory($this->getReference('category_Action'));
        $manager->persist($program2);

        $program3 = new Program();
        $program3->setTitle('How I met your mother');
        $program3->setSynopsis('Ted raconte à ses enfants comment il a rencontré sa femme, et ça lui prend 9 saisons.');
        $program3->setCategory($this->getReference('category_Humour'));
        $manager->persist($program3);

        $program4 = new Program();
        $program4->setTitle('Breaking bad');
        $program4->setSynopsis('Un père de famille sympa à la base se lance dans le commerce de drogue et devient un peu moins sympa.');
        $program4->setCategory($this->getReference('category_Action'));
        $manager->persist($program4);

        $manager->flush();
    }
    public function getDependencies()
    {
        return [
          CategoryFixtures::class,
        ];
    }
}
