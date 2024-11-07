<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProjectSubscription extends Model
{
    protected $fillable = [
        'user_id',
        'project_plan_id',
        'customer_id',
        'card_id',
        'start_date',
        'end_date',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function projectPlan()
    {
        return $this->belongsTo(ProjectPlan::class);
    }
}
