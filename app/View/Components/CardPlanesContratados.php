<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CardPlanesContratados extends Component
{
    public $planTitle;
    public $term;
    public $start;
    public $totalAdsHired;
    public $typicalAdsHired;
    public $topAdsHired;
    public $topPlusAdsHired;
    public $typicalAdsRemaining;
    public $topAdsRemaining;
    public $topPlusAdsRemaining;

    public function __construct($planTitle, $term, $start, $totalAdsHired, $typicalAdsHired, $topAdsHired, $topPlusAdsHired, $typicalAdsRemaining, $topAdsRemaining, $topPlusAdsRemaining)
    {
        $this->planTitle = $planTitle;
        $this->term = $term;
        $this->start = $start;
        $this->totalAdsHired = $totalAdsHired;
        $this->typicalAdsHired = $typicalAdsHired;
        $this->topAdsHired = $topAdsHired;
        $this->topPlusAdsHired = $topPlusAdsHired;
        $this->typicalAdsRemaining = $typicalAdsRemaining;
        $this->topAdsRemaining = $topAdsRemaining;
        $this->topPlusAdsRemaining = $topPlusAdsRemaining;
    }

    public function render(): View|Closure|string
    {
        return view('components.card-planes-contratados');
    }
}
