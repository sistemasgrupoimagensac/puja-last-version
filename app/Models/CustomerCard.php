<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerCard extends Model
{
    protected $fillable = [
        'user_id',
        'customer_id',
        'card_id',
        'card_brand',
        'card_last_digits',
        'expiration_month',
        'expiration_year',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
