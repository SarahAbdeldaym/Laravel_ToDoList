<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository {

    public function doesEmailExist(string $email) {
        return User::where('email', $email)->exists();
    }

    public function getUserByEmail(string $email) {
        return User::where('email', $email)->first();
    }

    public function createUser(string $name, string $email, string $password) {
        $user = new User();

        $user->name = $name;
        $user->email = $email;
        $user->password = $password;

        $user->save();

        return $user;
    }
}
