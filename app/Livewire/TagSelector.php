<?php

namespace App\Livewire;

use App\Models\CornerPost;
use App\Models\TagApp;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TagSelector extends Component
{

    public $selectedTags = [];
    public $tags;

    public function mount(){

    }

    public function render()
    {
        return view('livewire.tag-selector');
    }


}
