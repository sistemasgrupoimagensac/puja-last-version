<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionLevel extends Model
{
    use HasFactory;
    
    protected $table = "subscription_levels";
    protected $fillable = ['subscription_id', 'name', 'estado'];

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }

    public function options()
    {
        return $this->hasMany(SubscriptionOption::class);
    }
}
