<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CategorieFixtures extends Fixture
{
    public const string CATEGORIE_REFERENCE = 'categorie_';

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $noms = ['Concert', 'Sport', 'Conférence', 'Atelier', 'Festival'];

        foreach ($noms as $index => $nom) {
            $categorie = new Categorie();
            $categorie->setNom($nom);
            $categorie->setCouleur($faker->hexColor());
            $categorie->setIcone($faker->word());

            $manager->persist($categorie);

            // Référence pour les autres fixtures
            $this->addReference(self::CATEGORIE_REFERENCE . $index, $categorie);
        }

        $manager->flush();
    }
}
