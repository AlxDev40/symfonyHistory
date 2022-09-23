<?php

namespace App\DataFixtures;

use Faker\Factory;
use Faker\Generator;
use App\Entity\Battle;
use App\Entity\Character;
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
        //Add Character
        $characters = [];
        for ($i = 0; $i < 50; $i++) {
            $character = new Character();
            $character->setName($this->faker->name($gender =  'male' | 'female'));
            $character->setBirthDate($this->faker->dateTime());
            $character->setDeathDate($this->faker->dateTime());

            $characters[] = $character;

            $manager->persist($character);
        }

        //add Battle
        for ($j = 0; $j < 50; $j++) {
            $battle = new Battle();
            $battle->setName($this->faker->sentence(3));
            $battle->setDate($this->faker->dateTime());
            $battle->setLocation($this->faker->city());

            for ($k = 0; $k < mt_rand(1, 3); $k++) {
                $battle->addCharacter($characters[mt_rand(0, count($characters) - 1)]);
            }
            $manager->persist($battle);
        }

        $manager->flush();
    }
}
