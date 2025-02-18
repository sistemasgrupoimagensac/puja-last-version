<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationEmail extends Model
{
    use HasFactory;

    protected $table = "notifications_emails";
    protected $fillable = ['email', 'owner_name', 'status', 'action_type'];

    public const ACTION_NEW_AD = 1;
    public const ACTION_NEW_USER = 2;

    public function isActive(): bool
    {
        return $this->status;
    }

}
