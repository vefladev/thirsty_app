<?php

namespace App\DataFixtures;

use App\Entity\Etablissement;
use Faker\Factory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
// use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $faker = Factory::create('fr_FR');
        for ($e = 0; $e < 20; $e++) {
            $etablissement  = new Etablissement;
            $nom = $faker->lastName();
            $etablissement->setNom("Le bar de $nom");
            $adresse = $faker->address();
            $etablissement->setAdresse($adresse);
            $siret = $faker->phoneNumber();
            $etablissement->setSiret($siret);
            $photo_etablissement = $faker->imageUrl(400, 300, 'cats');
            $etablissement->setPhotoEtablissement($photo_etablissement);

            $manager->persist($etablissement);
        }

        $manager->flush();
    }
}
