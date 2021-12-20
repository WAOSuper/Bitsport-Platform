<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 
class Sponser extends Model
{
    public function cat() 
    {
        return $this->hasOne('App\Models\SubCategory','parent_id', 'id');
    }
    public function subcat()
    {
        return $this->hasMany('App\Models\SubCategory','parent_id', 'id');
    }


      public function sub_category()
    {
       return $this->belongsTo('App\Models\SubCategory', 'id', 'parent_id')->select(['name','slug','parent_id']);
    }

     
}
