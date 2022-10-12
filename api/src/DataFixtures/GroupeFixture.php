<?php

namespace App\DataFixtures;

use App\Entity\Groupe;
use App\Entity\Hackathon;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class GroupeFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $hackathons = $manager->getRepository(Hackathon::class)->findAll();
        for ($i=0; $i<100; $i++){
            $hackathon = $hackathons[array_rand($hackathons)];
            $groupe = new Groupe();
            $groupe->setHackathon($hackathon);
            $manager->persist($groupe);
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            HackathonFixture::class
        ];
    }
}
