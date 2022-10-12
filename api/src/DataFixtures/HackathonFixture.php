<?php

namespace App\DataFixtures;

use App\Entity\Hackathon;
use Bezhanov\Faker\Provider\Commerce;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class HackathonFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        $faker->addProvider(new Commerce($faker));

        //Create 20 Hackathons
        for ($i=0; $i<20; $i++){
            $hackathon = new Hackathon();
            $hackathon->setName($faker->productName);
            $hackathon->setCustomer($faker->name);
            $hackathon->setStartDate($faker->dateTimeBetween('-1 years', 'now'));
            $hackathon->setEndDate($faker->dateTimeBetween('now', '+1 years'));
            $manager->persist($hackathon);
        }

        $manager->flush();
    }
}
