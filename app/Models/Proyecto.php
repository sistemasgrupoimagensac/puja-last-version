<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    // Relación con las unidades del proyecto
    public function unidades()
    {
        return $this->hasMany(UnidadProyecto::class);
    }

    // Método para recalcular y actualizar las variables del proyecto
    public function recalcularValores()
    {
        // Recalcula y guarda los valores en las columnas respectivas
        $this->area_desde = $this->unidades()->min('area');
        $this->area_hasta = $this->unidades()->max('area');
        $this->area_techada_desde = $this->unidades()->min('area_techada');
        $this->area_techada_hasta = $this->unidades()->max('area_techada');
        $this->dormitorios_desde = $this->unidades()->min('dormitorios');
        $this->dormitorios_hasta = $this->unidades()->max('dormitorios');
        $this->banios_desde = $this->unidades()->min('banios');
        $this->banios_hasta = $this->unidades()->max('banios');
        $this->precio_desde = $this->unidades()->min('precio_soles');

        // Guarda los valores calculados en la base de datos
        $this->save();
    }
}
