<?php

namespace App\DataFixtures;

use App\Entity\Etablissement;
use App\Entity\InfoEtablissement;
use App\Entity\Manager;
use Faker\Factory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $omanager)
    {

        $faker = Factory::create('fr_FR');
        for ($m = 0; $m < 7; $m++) {
            $manager  = new Manager;
            $nom = $faker->lastName();
            $prenom = $faker->firstName();
            $manager->setNom($nom);
            $manager->setPrenom($prenom);
            $nomM =  lcfirst($nom);
            $prenomM =  lcfirst($prenom);
            $manager->setEmail("$nomM.$prenomM@mail.com");
            $password = $this->encoder->hashPassword($manager, 'admin');
            $manager->setPassword($password);
            $immat = $faker->phoneNumber();
            $manager->setImmatriculation($immat);
            $date_de_naissance = $faker->dateTimeBetween('-60 years', '-18 years');
            $manager->setDateDeNaissance($date_de_naissance);
            $manager->setRoles(["ROLE_ADMIN"]);

            $omanager->persist($manager);
            for ($e = 0; $e < 3; $e++) {
                $etablissement  = new Etablissement;
                $nom = $faker->lastName();
                $etablissement->setNom("Le bar de $nom");
                $adresse = $faker->address();
                $etablissement->setAdresse($adresse);
                $siret = $faker->phoneNumber();
                $etablissement->setSiret($siret);
                $photo_etablissement = $faker->imageUrl(400, 300, 'cats');
                $etablissement->setPhotoEtablissement($photo_etablissement);
                $etablissement->setManager($manager);

                $omanager->persist($etablissement);

                $info_etab = new InfoEtablissement;

                $info_etab->setHoraires('11h00 - 02h00');
                $info_etab->setDescription($faker->text);
                $info_etab->setMenu('Ceci est une photo du menu');
                $info_etab->setEtablissement($etablissement);

                $omanager->persist($info_etab);
            }
        }
        $omanager->flush();
    }
}
