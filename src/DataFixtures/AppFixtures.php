<?php

namespace App\DataFixtures;

use App\Entity\Character;
use App\Entity\Movie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $movie = new Movie();
        $movie->setName('Spider Man');
        $movie->setDescription('Best movie');
        $manager->persist($movie);

        $product = new Character();
        $product->setName('Peter Park');
        $product->addMovies($movie);
        $manager->persist($product);

        $product2 = new Character();
        $product2->setName('Mary Jane');
        $product->addMovies($movie);
        $manager->persist($product2);

        $manager->flush();
    }
}
