<?php

namespace App\DataFixtures;

use App\Entity\Actor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ActorFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {


        $actor = new Actor();
        $actor->setName('Keanu Reeves');
        $manager->persist($actor);

        $actor2 = new Actor();
        $actor2->setName('Laurence Fishburne');
        $manager->persist($actor2);

        $actor3 = new Actor();
        $actor3->setName('Carrie-Anne Moss');
        $manager->persist($actor3);

        $actor4 = new Actor();
        $actor4->setName('Hugo Weaving');
        $manager->persist($actor4);

        $actor5 = new Actor();
        $actor5->setName('Gloria Foster');
        $manager->persist($actor5);

        $manager->flush();

        $this->addReference('actor-1', $actor);
        $this->addReference('actor-2', $actor2);
        $this->addReference('actor-3', $actor3);
        $this->addReference('actor-4', $actor4);
        $this->addReference('actor-5', $actor5);

    }
}
