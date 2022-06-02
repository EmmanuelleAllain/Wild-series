<?php

namespace App\DataFixtures;

use App\Entity\Actor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ActorFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        $nbOfPrograms = count(ProgramFixtures:: PROGRAMS) -1;

        for($i = 0; $i < 10; $i++) {
            $actor = new Actor();
            $actor->setName($faker->firstName() . ' ' . $faker->lastName());
            for ($j = 0; $j < 3; $j++) {
            $actor->addProgram($this->getReference('program_' . $faker->numberBetween(0, $nbOfPrograms)));
            }
            $manager->persist($actor);
        }
        $manager->flush();
    }
    public function getDependencies()
    {
        return [
          ProgramFixtures::class,
        ];
    }
}
