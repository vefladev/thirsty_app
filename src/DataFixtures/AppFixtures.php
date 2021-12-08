<?php

namespace App\DataFixtures;

use App\Entity\Etablissement;
use Faker\Factory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
// use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{


    public function __construct()
    {
    }
    // private $encoder;

    // public function __construct(UserPasswordHasherInterface $encoder)
    // {
    //     $this->encoder = $encoder;
    // }

    // les fixtures sont des fausses données qu'on peut charger dans la bdd pour des tests
    public function load(ObjectManager $manager)
    {

        $faker = Factory::create('fr_FR');
        // création d'un faux admin
        // $admin  = new Etablissement;
        // $admin->setPrenom($faker->firstName());
        // $admin->setNom($faker->lastName());
        // $admin->setEmail("admin@email.com");
        // $password = $this->encoder->hashPassword($admin, 'admin');
        // $admin->setPassword($password);
        // $admin->setRoles(["ROLE_ADMIN"]);

        // $manager->persist($etablissement);

        // création d'un faux jeu de données users avec les données crée par faker
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
