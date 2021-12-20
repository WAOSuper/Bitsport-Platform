<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mode extends Model
{

    protected $table = 'modes';

    protected $fillable = [
        'name'
    ];

    public function platfrom()
    {
        return $this->belongsTo('App\Models\Platfrom');
    }
}
