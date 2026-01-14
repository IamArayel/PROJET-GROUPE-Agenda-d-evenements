<?php

namespace App\DataFixtures;

use App\Entity\Evenement;
use App\Entity\Categorie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Factory;

class EvenementFixtures extends Fixture implements DependentFixtureInterface
{
    public const string EVENEMENT_REFERENCE = 'evenement_';

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 20; $i++) {
            $evenement = new Evenement();
            $evenement->setTitre($faker->sentence(3));
            $evenement->setDescription($faker->paragraph(3));
            $evenement->setDate($faker->dateTimeBetween('-1 month', '+6 months'));
            $evenement->setLieu($faker->city());
            $evenement->setImage($faker->imageUrl(640, 480, 'event'));

            // relation avec une catégorie au hasard
            $evenement->setRelation(
                $this->getReference(
                    CategorieFixtures::CATEGORIE_REFERENCE . rand(0, 4),
                    Categorie::class
                )
            );


            $manager->persist($evenement);

            $this->addReference(self::EVENEMENT_REFERENCE . $i, $evenement);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            CategorieFixtures::class,
        ];
    }
}
