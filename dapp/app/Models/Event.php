<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{

    protected $fillable = [
        'cat_id',
        'sub_cat_id',
        'sub_sub_cat_id',
        'master_id',
        'event_master_id',
        'channel_id',
        'twich_url',
        'team_1_id',
        'odds',
        'team_2_id',
        'odds2',
        'draw',
        'start_date',
        'end_date',
        'live',
        'status',
        'winloss',
        'winner',
        'is_deleted',
        'is_approve',
        'created_by',
        'tournament_id',
        'team_1_score',
        'team_2_score',
        'team_1_check_in',
        'team_2_check_in',
        'match_id',
    ];

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
    public function P2PTeam1()
    {
        return $this->hasOne('App\User', 'id', 'team_1_id');
    }

    // Get data from Team Model
    public function P2PTeam2()
    {
        return $this->hasOne('App\User', 'id', 'team_2_id');
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

    public function match()
    {
        return $this->belongsTo('App\Models\Match', 'match_id', 'id');
    }
}
