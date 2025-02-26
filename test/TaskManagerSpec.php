<?php

namespace Boumilmounir\TestUnitaire;

use PHPUnit\Framework\TestCase;

class TaskManagerSpec extends TestCase
{
    public function testAddTask(): void
    {
        $taskManager = new TaskManager();
        $taskManager->addTask("Acheter du lait");

        $this->assertCount(1, $taskManager->getTasks());
        $this->assertEquals("Acheter du lait", $taskManager->getTask(0));
    }

    public function testRemoveTask(): void
    {
        $taskManager = new TaskManager();
        $taskManager->addTask("Acheter du lait");
        $taskManager->addTask("Faire du sport");
        $taskManager->removeTask(0);

        $this->assertCount(1, $taskManager->getTasks());
        $this->assertEquals("Faire du sport", $taskManager->getTask(0));
    }

    public function testGetTasks(): void
    {
        $taskManager = new TaskManager();
        $taskManager->addTask("Acheter du lait");
        $taskManager->addTask("Faire du sport");

        $this->assertEquals(["Acheter du lait", "Faire du sport"], $taskManager->getTasks());
    }

    public function testGetTask(): void
    {
        $taskManager = new TaskManager();
        $taskManager->addTask("Lire un livre");

        $this->assertEquals("Lire un livre", $taskManager->getTask(0));
    }

    public function testRemoveInvalidIndexThrowsException(): void
    {
        $this->expectException(\OutOfBoundsException::class);

        $taskManager = new TaskManager();
        $taskManager->removeTask(0);
    }

    public function testGetInvalidIndexThrowsException(): void
    {
        $this->expectException(\OutOfBoundsException::class);

        $taskManager = new TaskManager();
        $taskManager->getTask(0);
    }

    public function testTaskOrderAfterRemoval(): void
    {
        $taskManager = new TaskManager();
        $taskManager->addTask("Tâche 1");
        $taskManager->addTask("Tâche 2");
        $taskManager->addTask("Tâche 3");

        $taskManager->removeTask(1);

        $this->assertEquals(["Tâche 1", "Tâche 3"], $taskManager->getTasks());
        $this->assertEquals("Tâche 3", $taskManager->getTask(1));
    }
}
