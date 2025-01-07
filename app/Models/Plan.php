<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;
    
    protected $table = "plans";
    protected $fillable = ['package_id', "name", 'price', "duration_in_days", 'total_ads', "typical_ads", 'top_ads', "premium_ads", "promotion_id", "promotion2_id"];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'plan_user')->withPivot('estado');
    }

    public function promotion()
    {
        return $this->belongsTo(Promotion::class);
    }

    public function promotion2()
    {
        return $this->belongsTo(Promotion::class, 'promotion2_id');
    }

}
