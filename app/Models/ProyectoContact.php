<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProyectoContact extends Model
{
    use HasFactory;

    protected $table = 'proyecto_contacts';  // Nombre de la tabla asociada

    protected $fillable = [
        'proyecto_id',
        'user_id',
        'status',
        'full_name',
        'email',
        'phone',
        'message',
        'accept_terms',
        'time',
    ];

    /**
     * Relación con el modelo Proyecto.
     */
    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'proyecto_id');
    }

    /**
     * Relación con el modelo User.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
