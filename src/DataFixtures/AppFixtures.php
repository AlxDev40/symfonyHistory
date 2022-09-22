<?php

namespace App\DataFixtures;

use App\Entity\Character;
use Faker\Factory;
use Faker\Generator;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
    }

    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 50; $i++) {
            $character = new Character();
            $character->setName($this->faker->name($gender =  'male' | 'female'));
            $character->setBirthDate($this->faker->dateTime());
            $character->setDeathDate($this->faker->dateTime());

            $manager->persist($character);
        }
        $manager->flush();
    }
}
