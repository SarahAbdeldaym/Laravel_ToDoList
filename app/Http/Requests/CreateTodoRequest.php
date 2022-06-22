<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTodoRequest extends FormRequest {

    public function rules() {
        return [
            'title' => [ 'required' ],
            'body' => [ 'required' ]
        ];
    }
}
