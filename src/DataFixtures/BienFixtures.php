<?php

namespace App\DataFixtures;

use App\Entity\Bien;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class BienFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for($i = 0; $i < 100; $i++){
            $bien = new Bien();
            $bien->setTitle($faker->words(3,true))
                ->setPrix($faker->numberBetween(150000,100000000))
                ->setDescription($faker->sentences(3,true))
                ->setSurface($faker->numberBetween(10,350))
                ->setNbrePiece($faker->numberBetween(1,10))
                ->setNbreChambre($faker->numberBetween(1,10))
                ->setVille($faker->city)
                ->setAddresse($faker->address)
                ->setType($faker->numberBetween(0,count(Bien::TYPE) - 1))
                ->setObjectif($faker->numberBetween(0,count(Bien::OBJECTIF) - 1))
                ->setDisponibilite(true);
            $manager->persist($bien);
    }

        $manager->flush();
    }
}
