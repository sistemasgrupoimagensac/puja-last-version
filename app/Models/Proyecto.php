<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Proyecto extends Model
{
    protected $table = 'proyectos';

    protected $fillable = [
        'nombre_proyecto',
        'unidades_cantidad',
        'banco_id',
        'proyecto_progreso_id',
        'proyecto_cliente_id',
        'descripcion',
        'fecha_entrega',
        'area_desde',
        'area_hasta',
        'area_techada_desde',
        'area_techada_hasta',
        'dormitorios_desde',
        'dormitorios_hasta',
        'banios_desde',
        'banios_hasta',
        'precio_desde',
        'direccion',
        'distrito',
        'provincia',
        'departamento',
        'latitude',
        'longitude',
        'slug',
    ];

    protected static function boot()
    {
        parent::boot();

        // Generar el slug antes de crear o actualizar el proyecto
        static::saving(function ($model) {
            if (empty($model->slug)) {
                $model->slug = $model->generateSlug($model->nombre_proyecto);
            }
        });
    }

    /**
    * Método para generar el slug basado en el nombre del proyecto
    */
    public function generateSlug($nombreProyecto)
    {
        $baseSlug = Str::slug($nombreProyecto); // Convertir el nombre del proyecto en slug
        $slug = $baseSlug;

        $counter = 1;

        // Asegurarse de que el slug es único
        while (Proyecto::where('slug', $slug)->exists()) {
            $slug = "{$baseSlug}-{$counter}";
            $counter++;
        }

        return $slug;
    }

    public function unidades()
    {
        return $this->hasMany(ProyectoUnidades::class);
    }

    public function banco()
    {
        return $this->belongsTo(Banco::class);
    }

    public function progreso()
    {
        return $this->belongsTo(ProyectoProgreso::class, 'proyecto_progreso_id');
    }

    public function cliente()
    {
        return $this->belongsTo(ProyectoCliente::class, 'proyecto_cliente_id');
    }

    // public function proyectoCliente()
    // {
    //     return $this->belongsTo(ProyectoCliente::class, 'proyecto_cliente_id');
    // }

    // Relación con imágenes principales
    public function imagenesPrincipales()
    {
        return $this->hasMany(ProyectoImagenesPrincipal::class)->where('estado', 1);
    }

    // Relación con imágenes adicionales
    public function imagenesAdicionales()
    {
        return $this->hasMany(ProyectoImagenesAdicionales::class)->where('estado', 1);
    }

    // Modificar el método para recalcular solo con unidades activas
    public function recalcularValores()
    {
        // Filtrar solo las unidades con estado = 1
        $unidadesActivas = $this->unidades()->where('estado', 1);

        $this->update([
            'area_desde' => $unidadesActivas->min('area'),
            'area_hasta' => $unidadesActivas->max('area'),
            'area_techada_desde' => $unidadesActivas->min('area_techada'),
            'area_techada_hasta' => $unidadesActivas->max('area_techada'),
            'dormitorios_desde' => $unidadesActivas->min('dormitorios'),
            'dormitorios_hasta' => $unidadesActivas->max('dormitorios'),
            'banios_desde' => $unidadesActivas->min('banios'),
            'banios_hasta' => $unidadesActivas->max('banios'),
            'precio_desde' => $unidadesActivas->min('precio_soles'),
        ]);
    }
}