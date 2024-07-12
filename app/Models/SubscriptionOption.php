<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionOption extends Model
{
    use HasFactory;
    
    protected $table = "subscription_options";
    protected $fillable = ['subscription_level_id', 'num_ads_typical', 'num_ads_top', 'num_ads_top_plus', 'num_days', 'price', 'estado'];

    public function level()
    {
        return $this->belongsTo(SubscriptionLevel::class);
    }
}
