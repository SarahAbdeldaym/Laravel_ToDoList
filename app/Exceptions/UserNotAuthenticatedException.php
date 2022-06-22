<?php

namespace App\Exceptions;

use Exception;

class UserNotAuthenticatedException extends Exception {

    public function __construct() {
        parent::__construct('User not authenticated.');
    }
}
