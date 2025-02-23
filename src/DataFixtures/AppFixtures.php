<?php

namespace App\DataFixtures;

use App\Entity\Task;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $titles = [
            'Buy milk',
            'Take out the trash',
            'Wash the dishes',
            'Do the laundry',
            'Vacuum the floor',
        ];

        foreach ($titles as $title) {
            $task = new Task();
            $task->setTitle($title);
            $task->setIsCompleted(false);
            $task->setCreatedAt(new \DateTime());

            $manager->persist($task);
        }

        $manager->flush();
    }
}
