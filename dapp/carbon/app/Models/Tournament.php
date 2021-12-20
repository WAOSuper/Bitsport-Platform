<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    protected $dates = ['start_date_time'];

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'created_by');
    }

    public function category()
    {
        return $this->hasOne('App\Models\Category', 'id', 'cat_id')->select(['name','slug','id']);
    }

    public function subcategory()
    {
        return $this->hasOne('App\Models\SubCategory', 'id', 'sub_cat_id');
    }
}