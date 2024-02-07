<?php

namespace App\DataFixtures;

use App\Entity\Course;
use App\Entity\CourseStatus;
use App\Entity\User;
use App\Entity\UserCourseStatus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class UserFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        $user = new User();
        $user->setEmail($faker->email);
        $user->setPassword('boo');
        $user->setToken($faker->uuid);
        $user->setRoles(['ROLE_USER']);

        $courses = $manager->getRepository(Course::class)->findAll();
        for ($i = 0; $i < 8; $i++) {
            $user->addCourse($faker->randomElement($courses));
        }

        foreach ($user->getCourses() as $course) {
            $userCourseStatus = new UserCourseStatus();
            $userCourseStatus->setCourse($course);
            $userCourseStatus->setCourseStatus($manager->getRepository(CourseStatus::class)
                ->findOneBy([
                    'name' => $faker->randomElement(['subscribed_to', 'completed', 'started', 'not_started'])
                ]));
            $userCourseStatus->setCourseUser($user);
            $manager->persist($userCourseStatus);
        }
        $manager->persist($user);
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            CourseStatusFixture::class,
            CourseFixture::class,
        ];
    }
}
