<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public function user()
    {
        return $this->hasOne('App\User', 'id', 'created_by');
    }

    // Get data from Category Model
    public function Cat()
    {
        return $this->hasOne('App\Models\Category', 'id', 'cat_id');
    }

    // Get data from SubCategory Model
    public function SubCat()
    {
        return $this->hasOne('App\Models\SubCategory', 'id', 'sub_cat_id');
    }

    // Get data from SubSubCategory Model
    public function SubSubCat()
    {
        return $this->hasOne('App\Models\SubSubCategory', 'id', 'sub_sub_cat_id');
    }

    // Get data from Event Master Model
    public function Master()
    {
        return $this->hasOne('App\Models\EventMaster', 'id', 'event_master_id');
    }

    public function eventMaster()
    {
        return $this->belongsTo('App\Models\EventMaster');
    }

    // Get data from Team Model
    public function Team1()
    {
        return $this->hasOne('App\Models\Team', 'id', 'team_1_id');
    }

    // Get data from Team Model
    public function Team2()
    {
        return $this->hasOne('App\Models\Team', 'id', 'team_2_id');
    }

    // Get data from Odds Model
    public function Odd()
    {
        return $this->hasMany('App\Models\Odd', 'event_id', 'id');
    }
    // Get data from Odds Model
    public function oddcount()
    {
        return $this->hasMany('App\Models\Odd', 'event_id', 'id');
    }

    // Get data from SubCategory Model
    public function subcatEvent()
    {
        return $this->hasOne('App\Models\SubCategory', 'id', 'sub_cat_id');
    }

    // Get data from SubSubCategory Model
    public function subsubcatEvent()
    {
        return $this->hasOne('App\Models\SubSubCategory', 'id', 'sub_sub_cat_id');
    }

    // Get data from Team Model
    public function Team1Event()
    {
        return $this->hasOne('App\Models\Team', 'id', 'team_1_id');
    }

    // Get data from Team Model
    public function Team2Event()
    {
        return $this->hasOne('App\Models\Team', 'id', 'team_2_id');
    }

    // Get data from Odd Master Model
    public function odd_master()
    {
        return $this->belongsTo('App\Models\OddMaster', 'master_id', 'id')->select(['odd_title','id']);
    }

    public function tournament()
    {
        return $this->hasOne('App\Models\Tournament', 'id', 'tournament_id');
    }
}
