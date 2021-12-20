<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['payment_id', 'hash', 'amount', 'user_id'];
}
