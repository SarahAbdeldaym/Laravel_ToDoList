<?php

namespace App\Services;

use App\Exceptions\EmailAlreadyExistsException;
use App\Exceptions\EntityNotFoundException;
use App\Exceptions\InvalidUserCredentialsException;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;


class UserService {

    public function __construct(private UserRepository $userRepository) {}

    public function signup(string $name, string $email, string $password) {
        if ($this->doesEmailExist($email)) {
            throw new EmailAlreadyExistsException($email);
        }

        return $this->userRepository->createUser($name, $email, Hash::make($password));
    }

    public function doesEmailExist(string $email) {
        return $this->userRepository->doesEmailExist($email);
    }

    public function login(string $email, string $password) {
        if (!auth()->attempt([ 'email' => $email, 'password' => $password ])) {
            throw new InvalidUserCredentialsException();
        }

        $user = $this->userRepository->getUserByEmail($email);

        if (is_null($user)) {
            throw new InvalidUserCredentialsException();
        }

        return JWTAuth::fromUser($user);
    }
}
