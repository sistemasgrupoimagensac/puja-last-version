<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CardPlanPropietario extends Component
{
    public $title;
    public $tipoAviso;
    public $price;
    public $time;
    public $plan;
    public $className;
    public $avisos;

    public function __construct($title, $tipoAviso, $price, $time, $plan, $className, $avisos)
    {
        $this->title = $title;
        $this->tipoAviso = $tipoAviso;
        $this->price = $price;
        $this->time = $time;
        $this->plan = $plan;
        $this->className = $className;
        $this->avisos = $avisos;
    }
    
    public function render(): View|Closure|string
    {
        return view('components.card-plan-propietario');
    }
}
