<?php

namespace App\DataFixtures;

use App\Entity\Event;
use App\Entity\Hackathon;
use Bezhanov\Faker\Provider\Commerce;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class EventFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        $faker->addProvider(new Commerce($faker));
        $hackathons = $manager->getRepository(Hackathon::class)->findAll();

        //create 50 events
        for ($i=0; $i<50; $i++){
            $hackathon = $hackathons[array_rand($hackathons)];
            $event = new Event();
            $eventDate = $faker->dateTimeBetween($hackathon->getStartDate(), $hackathon->getEndDate());
            $event->setName($faker->productName);
            $event->setStartDate($eventDate);
            $event->setDescription($faker->text);
            $event->setReward('Reward ' . $i);
            $event->setHackathon($hackathon);
            $manager->persist($event);
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
