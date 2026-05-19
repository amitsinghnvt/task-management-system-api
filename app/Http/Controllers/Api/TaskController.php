<?php

namespace App\Http\Controllers\Api;

use App\Models\Task;
use App\Services\TaskService;
use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;

class TaskController extends Controller
{
    protected $taskService;

    public function __construct(
        TaskService $taskService
    ) {
        $this->taskService = $taskService;
    }

    public function index()
    {
        $tasks = $this->taskService->listTasks(
            auth()->user(),
            request()->all()
        );

        return TaskResource::collection($tasks);
    }

    public function store(StoreTaskRequest $request)
    {
        $task = $this->taskService->createTask(
            auth()->user(),
            $request->validated()
        );

        return response()->json([
            'success' => true,
            'message' => 'Task created successfully',
            'data' => new TaskResource($task)
        ], 201);
    }

    public function show($id)
    {
        $task = $this->taskService->getTask($id);

        $this->authorizeTask($task);

        return new TaskResource($task);
    }

    public function update(
        UpdateTaskRequest $request,
        $id
    ) {
        $task = $this->taskService->getTask($id);

        $this->authorizeTask($task);

        $updatedTask = $this->taskService->updateTask(
            $task,
            $request->validated()
        );

        return response()->json([
            'success' => true,
            'message' => 'Task updated successfully',
            'data' => new TaskResource($updatedTask)
        ], 200);
    }

    public function destroy($id)
    {
        $task = $this->taskService->getTask($id);

        $this->authorizeTask($task);

        $this->taskService->deleteTask($task);

        return response()->json([
            'success' => true,
            'message' => 'Task deleted successfully'
        ], 200);
    }

    private function authorizeTask(Task $task)
    {
        if ($task->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }
    }
}