<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class WhatsappModalContact extends Component
{
    public $idCaracteristica;
    public $isPuja;

    /**
     * Create a new component instance.
     */
    public function __construct($idCaracteristica = null, $isPuja = null)
    {
        $this->idCaracteristica = $idCaracteristica;
        $this->isPuja = $isPuja;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.whatsapp-modal-contact');
    }
}
