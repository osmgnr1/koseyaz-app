<?php

namespace App\Livewire;

use App\Models\Viewer;
use Livewire\Component;

class ViewersCounter extends Component
{

    public $viewers;


    public function mount(int $cornerPostId)
    {
        $this->viewers = Viewer::where('corner_post_id', $cornerPostId)->count();
        return view('livewire.viewers-counter');
    }
    public function render()
    {
        return view('livewire.viewers-counter');
    }
}
