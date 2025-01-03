<?php

namespace App\View\Components;

use Closure;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CardPlan extends Component
{
    public $title;
    public $price;
    public $time;
    public $plan;
    public $className;
    public $avisos;
    public $sesionIniciada;

    public function __construct($title, $price, $time, $plan, $className, $avisos, $sesionIniciada)
    {
        $this->title = $title;
        $this->price = $price;
        $this->time = $time;
        $this->plan = $plan;
        $this->className = $className;
        $this->avisos = $avisos;
        $this->sesionIniciada = $sesionIniciada;
    }

    public function render(): View|Closure|string
    {
        return view('components.card-plan');
    }
}
