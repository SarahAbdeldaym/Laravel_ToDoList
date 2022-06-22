<?php

namespace App\Exceptions;

use Exception;

class UnauthorizedException extends Exception {

    public function __construct() {
        parent::__construct('User not authorized for this action.');
    }
}
