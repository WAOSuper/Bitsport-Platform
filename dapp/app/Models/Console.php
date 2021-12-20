<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Console extends Model
{
    protected $table = 'consoles';

    protected $fillable = [
        'name'
    ];
}
