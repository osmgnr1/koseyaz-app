<?php

namespace App\Livewire;

use App\Models\Like;
use Livewire\Component;

class PostLikeCounter extends Component
{
    public $cornerpost_id;
    public function mount($cornerPostId){
        $this->cornerpost_id = $cornerPostId;
    }
    public function render()
    {
        return view('livewire.post-like-counter', [
            'likesCount' => Like::where('corner_post_id', $this->cornerpost_id)->count()
        ]);
    }
}
