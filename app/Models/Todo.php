<?php

namespace App\Models;

use Database\Factories\TodoFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Todo extends Model
{

    use HasFactory;

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    protected static function newFactory()
    {
        return TodoFactory::new();
    }
}
