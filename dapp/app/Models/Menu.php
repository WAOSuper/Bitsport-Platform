<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
	function parent()
	{
		return $this->hasMany('App\Models\Menu','parent1');
	}
   
}
