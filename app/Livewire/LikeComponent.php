<?php

namespace App\Livewire;

use App\Models\CornerPost;
use App\Models\Like;
use App\Notifications\UserLikeNotify;
use Livewire\Component;

class LikeComponent extends Component
{

    public $cornerpost_id;
    public $isLiked;

    public function mount($cornerPostId){
        $this->cornerpost_id = $cornerPostId;
        //check if likes table then assign isLiked corresponding value...
        $checker = Like::where([['user_id', auth()->user()->getAuthIdentifier()],['corner_post_id', $this->cornerpost_id]])
                        ->first();
        $this->isLiked = $checker == null ? false : true;

    }

    public function likeUnlike(){

        $cornerpost = CornerPost::find($this->cornerpost_id);
        $user = $cornerpost->user;

        //here we will perform like unlike functionality
        if ($this->isLiked == false) {
            $this->isLiked = true;

            //here we create new record in our likes table
            $likePost = new Like();
            $likePost->user_id = auth()->user()->id;
            $likePost->corner_post_id = $this->cornerpost_id;
            $likePost->save();

            $data = [
                'username' => auth()->user()->username,
                'title' => $cornerpost->title,
                'type' => 'like',
            ];



        }else {
            $this->isLiked = false;

            Like::where([['user_id', auth()->user()->getAuthIdentifier()],['corner_post_id', $this->cornerpost_id]])
            ->delete();

            $data = [
                'username' => auth()->user()->username,
                'title' => $cornerpost->title,
                'type' => 'dislike',
            ];
        }

        $user->notify(new UserLikeNotify($data));

    }


    public function render()
    {
        return view('livewire.like-component', [
            'likesCount' => Like::where('corner_post_id', $this->cornerpost_id)->count()
        ]);
    }
}
