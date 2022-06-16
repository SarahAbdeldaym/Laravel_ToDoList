<?php

namespace App\Repositories;

use App\Models\Todo;

class TodoRepository {

    public function getTodos(int $recordsPerPage = 20) {
        return Todo::paginate($recordsPerPage);
    }
}