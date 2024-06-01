<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\ComponentSlot;
use Illuminate\View\View;

class Layout extends Component
{
    public function __construct(public readonly ComponentSlot $slot, public readonly ?string $title = null)
    {

    }
    /**
     * @inheritDoc
     */
    public function render(): View
    {
        return view("components.layout");
    }
}
