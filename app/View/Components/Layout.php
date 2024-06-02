<?php

namespace App\View\Components;

use Illuminate\Http\Request;
use Illuminate\View\Component;
use Illuminate\View\ComponentSlot;
use Illuminate\View\View;

class Layout extends Component
{
    public readonly string $title;
    public function __construct(private readonly Request $request, public readonly ComponentSlot $slot, ?string $title)
    {
        if($title !== null) $this->title = $title." - ".config("app.name");
        else $this->title = config("app.name");
    }
    /**
     * @inheritDoc
     */
    public function render(): View
    {
        $this->request->attributes->set("title", $this->title);
        return view("components.layout", ["title" => $this->title]);
    }
}
