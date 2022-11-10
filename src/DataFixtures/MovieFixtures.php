<?php

namespace App\DataFixtures;

use App\Entity\Movie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MovieFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $movie = new Movie();
        $movie->setTitle('The Matrix');
        $movie->setReleaseYear(1999);
        $movie->setDescription('A computer hacker learns from mysterious rebels about the true nature of his reality and his role in the war against its controllers.');
        $movie->setImagePath('https://picsum.photos/200/300');
        $manager->persist($movie);


        $movie2 = new Movie();
        $movie2->setTitle('The Matrix Reloaded');
        $movie2->setReleaseYear(2000);
        $movie2->setDescription('A computer hacker learns from mysterious rebels about the true nature of his reality and his role in the war against its controllers.');
        $movie2->setImagePath('https://picsum.photos/200/300');
        $manager->persist($movie2);
        $manager->flush();

    }
}
