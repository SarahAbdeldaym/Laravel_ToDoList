<?php

namespace App\Repositories;

use App\Models\Todo;

class TodoRepository {

    public function getTodos(int $recordsPerPage = 20) {
        return Todo::with('user')->paginate($recordsPerPage);
    }

    public function createTodo(string $title,string $body,int $user_id){
        $todo = new Todo;
        $todo->title=$title;
        $todo->body=$body;
        $todo->is_done=false;
        $todo->user_id=$user_id;
        $todo->save();
        return $todo;
    }

    public function findTodo(int $todoId) {
        return Todo::find($todoId);
    }

    public function updateTodo(Todo $todo, ?string $title,?string $body,?int $user_id){
        if (!is_null($title)) {
            $todo->title=$title;
        }
        if (!is_null($body)) {
            $todo->body=$body;
        }

        if (!is_null($user_id)) {
            $todo->user_id=$user_id;
        }

        $todo->save();
        return $todo;
    }

    public function deleteTodo(int $todoId){
         Todo::find($todoId)->delete();
    }

    public function markTodoAsDone(Todo $todo){
        $todo->is_done=true;
        $todo->save();
        return $todo;
    }

}
