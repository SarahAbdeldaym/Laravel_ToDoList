<?php

namespace App\Services;

use App\Exceptions\EntityNotFoundException;
use App\Models\Todo;
use App\Repositories\TodoRepository;

class TodoService {

    public function __construct(
        private TodoRepository $todoRepository
    ) {}

    public function getTodos(){
        return $this->todoRepository->getTodos(config('app.recordsPerPage'));
    }

    public function createTodo(string $title,string $body){
        return $this->todoRepository->createTodo($title,$body);
    }
    
    public function updateTodo(int $todoId, ?string $title,?string $body){
        $todo = $this->findTodo($todoId);

        return $this->todoRepository->updateTodo($todo, $title,$body);
    }

    public function findTodo(int $todoId) {
        $todo = $this->todoRepository->findTodo($todoId);

        if (is_null($todo)) {
            throw new EntityNotFoundException('Todo', $todoId);
        }

        return $todo;
    }
}