<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Odd extends Model
{
    
    public function odd_master()
    {
       return $this->belongsTo('App\Models\OddMaster', 'id', 'odd_id')->select(['odd_title','id']);
    }

    public function odds()
    {
       return $this->hasMany('App\Models\OddMaster', 'id', 'odd_id')->select(['odd_title','id']);
    }

    public function event()
    {
       return $this->hasOne('App\Models\Event', 'id', 'event_id');
    }
    public function oddMasterName()
    {
        return $this->hasOne('App\Models\OddMaster', 'id', 'odd_id');
    }
    public function teamName()
    {
        return $this->hasOne('App\Models\Team', 'id', 'team_id')->select(['name','id']);
    }
    public function oddBet()
    {
        return $this->hasOne('App\Models\Bet', 'team_id', 'id');
    }
}
