<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{ 
	
  public function scroe()
    {
        return $this->hasOne('App\Models\Score', 'score', 'event_id', 'user_id', 'team_id');
    }
}

?>
