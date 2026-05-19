<?php

namespace App\Repositories\Interfaces;

interface TaskRepositoryInterface
{
    public function getAllTasks($user, array $filters);

    public function createTask($user, array $data);

    public function getTaskById(int $id);

    public function updateTask($task, array $data);

    public function deleteTask($task);
}