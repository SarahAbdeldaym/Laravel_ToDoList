<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTodoRequest;
use App\Services\TodoService;
use Illuminate\Http\Request;

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

    public function createTodo(CreateTodoRequest $request){
        $todo = $this->todoService->createTodo(
            $request->input("title"),
            $request->input("body")
        );

        return response()->json([
            'status' => true,
            'data' => $todo
        ]);
    }

}
