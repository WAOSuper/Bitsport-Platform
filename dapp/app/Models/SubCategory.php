<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    public function subcat()
    {
        return $this->hasOne('App\Models\Category','id', 'parent_id');
    }
    
    public function subsubcat()
    {
        return $this->hasMany('App\Models\SubSubCategory','parent_id', 'id');
    }

     public function sub_sub_category()
    {
       return $this->belongsTo('App\Models\SubSubCategory', 'id', 'parent_id')->select(['name','slug','parent_id']);
    }
}
