<?php

namespace App\Repositories;

use App\Models\Task;
use App\Repositories\Interfaces\TaskRepositoryInterface;

class TaskRepository implements TaskRepositoryInterface
{
    public function getAllTasks($user, array $filters)
    {
        $query = $user->tasks();

        if (isset($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        return $query
            ->latest()
            ->paginate(10);
    }

    public function createTask($user, array $data)
    {
        return $user->tasks()->create($data);
    }

    public function getTaskById(int $id)
    {
        return Task::findOrFail($id);
    }

    public function updateTask($task, array $data)
    {
        $task->update($data);

        return $task->fresh();
    }

    public function deleteTask($task)
    {
        return $task->delete();
    }
}