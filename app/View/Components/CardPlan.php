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
    public $avisosTipicos;
    public $avisosTop;
    public $avisosTopPlus;

    public function __construct($title, $price, $time, $plan, $className, $avisosTipicos, $avisosTop, $avisosTopPlus)
    {
        $this->title = $title;
        $this->price = $price;
        $this->time = $time;
        $this->plan = $plan;
        $this->className = $className;
        $this->avisosTipicos = $avisosTipicos;
        $this->avisosTop = $avisosTop;
        $this->avisosTopPlus = $avisosTopPlus;
    }

    public function render(): View|Closure|string
    {
        return view('components.card-plan');
    }
}
