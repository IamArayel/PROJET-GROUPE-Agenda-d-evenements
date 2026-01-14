<?php

namespace App\DataFixtures;

use App\Entity\Inscription;
use App\Entity\Evenement;
use App\DataFixtures\EvenementFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Factory;

class InscriptionFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 50; $i++) {
            $inscription = new Inscription();
            $inscription->setNom($faker->name());
            $inscription->setEmail($faker->email());
            $inscription->setTelephone($faker->phoneNumber());
            $inscription->setNombrePlaces($faker->numberBetween(1, 5));
            $inscription->setCreatedAt(
                $faker->dateTimeBetween('-2 months', 'now')
            );

            $inscription->setRelation(
                $this->getReference(
                    EvenementFixtures::EVENEMENT_REFERENCE . rand(0, 19),
                    Evenement::class
                )
            );

            $manager->persist($inscription);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            EvenementFixtures::class
        ];
    }
}
