<?php

namespace App\Exceptions;

use Exception;

class EntityNotFoundException extends Exception {

    public function __construct(private string $type, private int $id) {
        parent::__construct(
            sprintf('Entity of type %s not found for id %d', $type, $id)
        );
    }
}
