<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MilesComa extends Component
{
    public $amount;

    public function __construct($amount)
    {
        $this->amount = $amount;
    }
    public function render(): View|Closure|string
    {
        return view('components.miles-coma');
    }
}
