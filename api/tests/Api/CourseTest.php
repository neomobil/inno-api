<?php

namespace App\Tests\Api;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use Faker\Factory;

class CourseTest extends ApiTestCase
{
    // add $faker
    private $faker;
    public function setUp(): void
    {
        $this->faker = Factory::create();
    }

    public function testGetListOfCourses(): void
    {
        $response = static::createClient()->request('GET', '/courses', [
            'headers' => [
                'accept' => 'application/ld+json',
            ],
        ]);
        $this->assertResponseIsSuccessful();
        $this->assertJsonContains([
            '@context' => '/contexts/Course',
            '@id' => '/courses',
            '@type' => 'hydra:Collection',
            'hydra:totalItems' => 50,
        ]);
    }

}
