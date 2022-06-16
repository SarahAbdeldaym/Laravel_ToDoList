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


}