<?php

namespace App\Exceptions;

use Exception;

class TodoAlreadyDoneException extends Exception {

    public function __construct(private string $todoTitle) {
        parent::__construct(
            sprintf('The todo `%s` is already marked as done.', $todoTitle)
        );
    }
}
