<?php

namespace App\View\Components;

use Closure;
use App\Models\CornerPost as ModelCornerPost;
use DOMDocument;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Str;


class CornerPost extends Component
{
    // public ModelCornerPost $cornerpost;
    // public string $body;


    /**
     * Create a new component instance.
     */
    public function __construct(
        public ModelCornerPost $cornerpost,

    )
    {


    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.corner-post');
    }
}
