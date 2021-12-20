<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventMaster extends Model
{
    public function liveevents()
    {
        return $this->hasMany('App\Models\Event', 'event_master_id', 'id')->where('live',1)->where('match_id', NULL)->where('featured',0)->where('winloss', 0)->where('is_deleted', 0);
    }
    public function livep2pevents()
    {
        return $this->hasMany('App\Models\Event', 'event_master_id', 'id')->where('live',1)->where('match_id', '!=', NULL)->where('featured',0)->where('winloss', 0)->where('is_deleted', 0);
    }
    public function upcomingevents()
    {
        return $this->hasMany('App\Models\Event', 'event_master_id', 'id')->where('live',0)->where('winloss', 0)->where('is_deleted', 0);
    }
    public function events()
    {
        return $this->hasMany('App\Models\Event', 'event_master_id', 'id');
    }
    public function event()
    {
        return $this->hasOne('App\Models\Event', 'event_master_id', 'id');
    }
}