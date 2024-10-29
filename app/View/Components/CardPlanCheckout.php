<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CardPlanCheckout extends Component
{
    public $title;
    public $bgColor;
    public $showPlan;
    
    public function __construct($title, $bgColor, $showPlan)
    {
        $this->title = $title;
        $this->bgColor = $bgColor;
        $this->showPlan = $showPlan;
    }

    public function render(): View|Closure|string
    {
        return view('components.card-plan-checkout');
    }
}
