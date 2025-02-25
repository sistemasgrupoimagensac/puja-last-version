<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdContact extends Model
{
    use HasFactory;

    protected $table = "ad_contacts";
    protected $fillable = ['aviso_id', 'contact_type', 'user_id', 'status', 'full_name', 'email', 'phone', 'bid_amount', 'message', 'accept_terms', 'type_currency_id'];

    public function aviso()
    {
        return $this->belongsTo(Aviso::class);
    }
}
