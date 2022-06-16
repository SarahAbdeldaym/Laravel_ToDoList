<?php

namespace App\Http\Controllers;

use App\Services\TodoService;

class TodoController extends Controller
{

    public function __construct(
        private TodoService $todoService
    ) {}

    public function getTodos(){
        $todos = $this->todoService->getTodos();

        return response()->json([
            'status' => true,
            'data' => $todos
        ]);
    }


}
