<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Select2Tags extends Component
{

    // public $tags = "";

    public $tags = [];

    /**
     * Create a new component instance.
     */
    public function __construct(

    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.select2-tags');
    }
}
