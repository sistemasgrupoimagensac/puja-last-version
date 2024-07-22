<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;
    
    protected $table = "packages";
    protected $fillable = ['name', "user_type_id"];

    public function plans()
    {
        return $this->hasMany(Plan::class);
    }

    // public function options()
    // {
    //     return $this->hasManyThrough(SubscriptionOption::class, SubscriptionLevel::class);
    // }
}
