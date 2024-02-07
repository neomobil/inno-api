<?php

namespace App\DataFixtures;

use App\Entity\CourseStatus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CourseStatusFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        foreach (['subscribed_to', 'completed', 'started', 'not_started'] as $status) {
            $courseStatus = new CourseStatus();
            $courseStatus->setName($status);
            $courseStatus->setTitle(ucwords(str_replace('_', ' ', $status)));
            $manager->persist($courseStatus);
        }
        $manager->flush();
    }
}
