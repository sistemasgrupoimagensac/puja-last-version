<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class WhatsappModalContact extends Component
{
    public int $inmuebleId;

    public function __construct(int $inmuebleId)
    {
        $this->inmuebleId = $inmuebleId;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.whatsapp-modal-contact');
    }
}