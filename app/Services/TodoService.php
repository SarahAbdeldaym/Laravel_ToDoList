<?php

namespace App\Services;

use App\Exceptions\EntityNotFoundException;
use App\Exceptions\TodoAlreadyDoneException;
use App\Exceptions\TodoAlreadyOpenedException;
use App\Exceptions\UnauthorizedException;
use App\Models\Todo;
use App\Models\User;
use App\Repositories\TodoRepository;

class TodoService
{

    public function __construct(
        private UserService $userService,
        private TodoRepository $todoRepository
    ) {
    }

    public function getTodos()
    {
        return $this->todoRepository->getTodos(
            $this->userService->getLoggedInUser()->id,
            config('app.recordsPerPage')
        );
    }

    public function createTodo(string $title, string $body)
    {
        return $this->todoRepository->createTodo($title, $body, $this->userService->getLoggedInUser()->id);
    }

    public function updateTodo(int $todoId, ?string $title, ?string $body)
    {
        $todo = $this->findTodo($todoId, $this->userService->getLoggedInUser()->id);

        return $this->todoRepository->updateTodo($todo, $title, $body);
    }

    public function deleteTodo(int $todoId)
    {
        $this->findTodo($todoId, $this->userService->getLoggedInUser()->id);

        return $this->todoRepository->deleteTodo($todoId);
    }

    public function markTodoAsDone(int $todoId)
    {
        $todo = $this->findTodo($todoId, $this->userService->getLoggedInUser()->id);

        if ($todo->is_done) {
            throw new TodoAlreadyDoneException($todo->title);
        }

        return $this->todoRepository->markTodoAsDone($todo);
    }

    public function reopenTodo(int $todoId)
    {
        $todo = $this->findTodo($todoId, $this->userService->getLoggedInUser()->id);

        if (!$todo->is_done) {
            throw new TodoAlreadyOpenedException($todo->title);
        }

        return $this->todoRepository->reopenTodo($todo);
    }

    public function findTodo(int $todoId, ?int $userId = null)
    {
        $todo = $this->todoRepository->findTodo($todoId);

        if (is_null($todo)) {
            throw new EntityNotFoundException('Todo', $todoId);
        }

        if (!is_null($userId) && $userId != $todo->user_id) {
            throw new UnauthorizedException();
        }

        return $todo;
    }
}
