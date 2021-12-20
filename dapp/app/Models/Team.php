<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    public function user()
    {
        return $this->hasOne('App\User', 'id', 'created_by');
    }
    public function category()
    {
        return $this->hasOne('App\Models\Category', 'id', 'cate_id');
    }
    public function subcategory()
    {
        return $this->hasOne('App\Models\SubCategory', 'id', 'sub_cate');
    }
    public function subsubcategory()
    {
        return $this->hasOne('App\Models\SubSubCategory', 'id', 'sub_sub_cate');
    }
}
