<?php

namespace App\Repositories;

use App\Models\Todo;

class TodoRepository {

    public function getTodos(int $recordsPerPage = 20) {
        return Todo::paginate($recordsPerPage);
    }

    public function createTodo(string $title,string $body){
        $todo = new Todo;
        $todo->title=$title;
        $todo->body=$body;
        $todo->is_done=false;
        $todo->save();
        return $todo;
    }

    public function findTodo(int $todoId) {
        return Todo::find($todoId);
    }

    public function updateTodo(Todo $todo, ?string $title,?string $body){
        if (!is_null($title)) {
            $todo->title=$title;
        }
        if (!is_null($body)) {
            $todo->body=$body;
        }
        $todo->save();
        return $todo;
    }

    public function deleteTodo(int $todoId){
         Todo::find($todoId)->delete();
    }

}