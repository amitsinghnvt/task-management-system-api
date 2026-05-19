<?php

namespace App\Services;

use App\Repositories\Interfaces\TaskRepositoryInterface;

class TaskService
{
    protected $taskRepository;

    public function __construct(
        TaskRepositoryInterface $taskRepository
    ) {
        $this->taskRepository = $taskRepository;
    }

    public function listTasks($user, array $filters)
    {
        return $this->taskRepository
            ->getAllTasks($user, $filters);
    }

    public function createTask($user, array $data)
    {
        return $this->taskRepository
            ->createTask($user, $data);
    }

    public function getTask(int $id)
    {
        return $this->taskRepository
            ->getTaskById($id);
    }

    public function updateTask($task, array $data)
    {
        return $this->taskRepository
            ->updateTask($task, $data);
    }

    public function deleteTask($task)
    {
        return $this->taskRepository
            ->deleteTask($task);
    }
}