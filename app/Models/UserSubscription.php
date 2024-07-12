<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSubscription extends Model
{
    use HasFactory;
    
    protected $table = "user_subscriptions";
    protected $fillable = ['user_id', 'subscription_option_id', 'document_type_id', 'estado', 'start_date', 'end_date', 'physical_proof_number', 'file_name', 'state_et', 'state_billed'];

    public function client()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function option()
    {
        return $this->belongsTo(SubscriptionOption::class);
    }

    public function documentType()
    {
        return $this->belongsTo(DocumentType::class, 'document_type_id');
    }

    public function type_doc()
    {
        return optional($this->documentType)->type_doc;
    }

    // Definir un accesor para 'state'
    public function getStateAttribute()
    {
        return $this->attributes['estado'];
    }

    // Definir un mutador para 'state'
    public function setStateAttribute($value)
    {
        $this->attributes['estado'] = $value;
    }
}
