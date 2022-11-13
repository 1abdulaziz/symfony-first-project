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
        $movie->setImagePath('https://i.picsum.photos/id/1005/900/1000.jpg?hmac=RdjdLGaxmbwLyYMXxl_ZrAMx6jxXN9xZXmrvi2PU4OM');
        $movie->addActor($this->getReference('actor-1'));
        $movie->addActor($this->getReference('actor-3'));
        $manager->persist($movie);


        $movie2 = new Movie();
        $movie2->setTitle('The Matrix Reloaded');
        $movie2->setReleaseYear(2000);
        $movie2->setDescription('A computer hacker learns from mysterious rebels about the true nature of his reality and his role in the war against its controllers.');
        $movie2->setImagePath('https://i.picsum.photos/id/679/900/1000.jpg?hmac=8FgDErYGWE3tmXGqY9lfWrCBIESmNDLFokxqEPzwn-Y');
        $movie2->addActor($this->getReference('actor-4'));
        $movie2->addActor($this->getReference('actor-2'));
        $manager->persist($movie2);
        $manager->flush();


        $movie3 = new Movie();
        $movie3->setTitle('The Matrix Revolutions');
        $movie3->setReleaseYear(2001);
        $movie3->setDescription('A computer hacker learns from mysterious rebels about the true nature of his reality and his role in the war against its controllers.');
        $movie3->setImagePath('https://i.picsum.photos/id/764/900/1000.jpg?hmac=yKKPTHN_-iH9CXj8u_uPcHYZGa248JTYlYDmgZiGVXE');
        $movie3->addActor($this->getReference('actor-5'));
        $movie3->addActor($this->getReference('actor-1'));
        $manager->persist($movie3);
        $manager->flush();


    }
}
