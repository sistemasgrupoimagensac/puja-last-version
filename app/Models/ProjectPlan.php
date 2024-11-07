<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectPlan extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'duration_in_months',
        'status_after_retry',
        'retry_times',
        'currency',
    ];
}
