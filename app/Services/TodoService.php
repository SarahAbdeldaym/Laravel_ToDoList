<?php

namespace App\Services;

use App\Repositories\TodoRepository;

class TodoService {

    public function __construct(
        private TodoRepository $todoRepository
    ) {}

    public function getTodos(){
        return $this->todoRepository->getTodos(config('app.recordsPerPage'));
    }
}