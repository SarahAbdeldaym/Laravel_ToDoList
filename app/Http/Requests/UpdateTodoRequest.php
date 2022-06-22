<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTodoRequest extends FormRequest {

    public function rules() {
        return [
            'title' => [ 'nullable', 'min:1' ],
            'body' => [ 'nullable', 'min:1' ],
        ];
    }
}
