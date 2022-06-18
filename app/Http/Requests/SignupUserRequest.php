<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignupUserRequest extends FormRequest {

    public function rules() {
        return [
            'name' => [ 'required', 'min:3' ],
            'email' => [ 'required', 'email', 'unique:users,email' ],
            'password' => [ 'required', 'min:6' ],
            'confirm_password' => [ 'required', 'same:password' ]
        ];
    }
}
