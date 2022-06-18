<?php

namespace App\Exceptions;

use Exception;

class EmailAlreadyExistsException extends Exception {

    public function __construct(private string $email) {
        parent::__construct(
            sprintf('The email `%s` is already used by another user.', $email)
        );
    }
}
