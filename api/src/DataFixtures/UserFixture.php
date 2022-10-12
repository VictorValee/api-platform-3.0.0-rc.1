<?php

namespace App\DataFixtures;

use App\Entity\User;
use Bezhanov\Faker\Provider\Commerce;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class UserFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $jwt = '$2y$13$3h7aJ6lzxCAseCtiI1DFXu585EzHf/.KrG.axYLZpFW0/FIYerJAi';

        $object = (new User())
        ->setEmail('user@user.fr')
        ->setRoles(['ROLE_USER'])
        ->setPassword($jwt);

        $manager->persist($object);

        $object = (new User())
        ->setEmail('customer@cutomer.fr')
        ->setRoles(['ROLE_CUSTOMER'])
        ->setPassword($jwt);

        $manager->persist($object);

        $object = (new User())
        ->setEmail('coach@coach.fr')
        ->setRoles(['ROLE_COACH'])
        ->setPassword($jwt);

        $manager->persist($object);
    

        $manager->flush();
    }
}
