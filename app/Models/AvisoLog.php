<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AvisoLog extends Model
{
    protected $table = "aviso_logs";
    protected $fillable = ['aviso_id', 'type', 'request', 'response', 'success', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
