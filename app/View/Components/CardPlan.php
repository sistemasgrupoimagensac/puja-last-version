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
    public $text;
    public $plan;
    public $className;

    public function __construct($title, $price, $time, $text, $plan, $className)
    {
        $this->title = $title;
        $this->price = $price;
        $this->time = $time;
        $this->text = $text;
        $this->plan = $plan;
        $this->className = $className;
    }

    public function render(): View|Closure|string
    {
        return view('components.card-plan');
    }
}
