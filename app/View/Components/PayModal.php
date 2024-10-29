<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PayModal extends Component
{
    public $avisoId;

    public function __construct($avisoId)
    {
        $this->avisoId = $avisoId;
    }

    public function render(): View|Closure|string
    {
        return view('components.pay-modal');
    }
}
