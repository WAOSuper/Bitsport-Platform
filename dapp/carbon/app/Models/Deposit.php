<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{

	protected $fillable = ['user_id', 'amount', 'txid', 'address', 'coin_type', 'confirms'];

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}
