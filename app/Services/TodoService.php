<?php

namespace App\Services;

use App\Exceptions\EntityNotFoundException;
use App\Exceptions\TodoAlreadyDoneException;
use App\Exceptions\TodoAlreadyOpenedException;
use App\Models\Todo;
use App\Repositories\TodoRepository;

class TodoService {

    public function __construct(
        private TodoRepository $todoRepository
    ) {}

    public function getTodos(){
        return $this->todoRepository->getTodos(config('app.recordsPerPage'));
    }

    public function createTodo(string $title,string $body,int $user_id){
        return $this->todoRepository->createTodo($title,$body,$user_id);
    }

    public function updateTodo(int $todoId, ?string $title,?string $body,?int $user_id){
        $todo = $this->findTodo($todoId);

        return $this->todoRepository->updateTodo($todo, $title,$body,$user_id);
    }

    public function deleteTodo(int $todoId){
        $this->findTodo($todoId);
        return $this->todoRepository->deleteTodo($todoId);
    }

    public function markTodoAsDone(int $todoId){
        $todo = $this->findTodo($todoId);

        if ($todo->is_done) {
            throw new TodoAlreadyDoneException($todo->title);
        }

        return $this->todoRepository->markTodoAsDone($todo);
    }

    public function reopenTodo(int $todoId){
        $todo = $this->findTodo($todoId);

        if (!$todo->is_done) {
            throw new TodoAlreadyOpenedException($todo->title);
        }

        return $this->todoRepository->reopenTodo($todo);
    }

    public function findTodo(int $todoId) {
        $todo = $this->todoRepository->findTodo($todoId);

        if (is_null($todo)) {
            throw new EntityNotFoundException('Todo', $todoId);
        }

        return $todo;
    }
}
