<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanUser extends Model
{
    use HasFactory;
    
    protected $table = "plan_user";
    protected $fillable = ['user_id', "plan_id", 'document_type_id', "estado", "typical_ads_remaining", "top_ads_remaining", "premium_ads_remaining", "start_date", 'end_date', "physical_proof_number", 'file_name', "state_et", "state_billed"];

    public function client()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class, 'plan_id');
    }

    /* public function option()
    {
        return $this->belongsTo(SubscriptionOption::class);
    } */

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
