<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;
    
    protected $table = "plans";
    protected $fillable = ['package_id', "name", 'price', "duration_in_days", 'total_ads', "typical_ads", 'top_ads', "premium_ads"];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
