<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;
    
    protected $table = "subscriptions";
    protected $fillable = ['name'];

    public function levels()
    {
        return $this->hasMany(SubscriptionLevel::class);
    }

    public function options()
    {
        return $this->hasManyThrough(SubscriptionOption::class, SubscriptionLevel::class);
    }
}
