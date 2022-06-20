<?php

namespace App\Exceptions;

use Exception;

class TodoAlreadyOpenedException extends Exception {

    public function __construct(private string $todoTitle) {
        parent::__construct(
            sprintf('The todo `%s` is already opened.', $todoTitle)
        );
    }
}
