<?php

namespace App\Exceptions;

use Exception;

class InvalidUserCredentialsException extends Exception {

    public function __construct() {
        parent::__construct(
            sprintf('Either the specified email or/and password is/are wrong.')
        );
    }
}
