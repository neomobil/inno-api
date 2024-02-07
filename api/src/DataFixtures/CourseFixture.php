<?php

namespace App\DataFixtures;

use App\Entity\Course;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CourseFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        for ($i = 1; $i <= 50; $i++) {
            $course = new Course();
            $course->setTitle($faker->words(3, true) . ' Course ' . $i);
            $manager->persist($course);
        }
        $manager->flush();
    }
}
