<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    protected $fillable = [
        'percentage',
        'promo_start',
        'promo_end',
        'status',
    ];

    public function plans()
    {
        return $this->hasMany(Plan::class);
    }
    
}
