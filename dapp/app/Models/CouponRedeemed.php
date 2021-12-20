<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CouponRedeemed extends Model
{
	protected $table = 'coupon_redeemed';

    protected $fillable = ['coupon_id', 'user_id', 'amount'];

    public function user()
    {
       return $this->hasOne('App\User', 'id', 'user_id');
    }
}
