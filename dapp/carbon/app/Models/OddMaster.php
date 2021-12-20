<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OddMaster extends Model
{
    public function odds()
    {

    	return $this->hasMany('App\Models\Odd','odd_id','id');
    }
}
