<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubSubCategory extends Model
{
     public function subsubcat()
    {
        return $this->hasOne('App\Models\SubCategory','id', 'parent_id');
    }

    

}
