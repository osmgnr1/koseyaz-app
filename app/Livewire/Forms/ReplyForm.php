<?php

namespace App\Livewire\Forms;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ReplyForm extends Form
{
    #[Validate('required',message:'Please enter a reply.')]
    public $body;

    public function storeReply(Comment $comment){

        $this->validate();

        $reply = $comment->replies()->make([
            'body'=> $this->body,
            'user_id' => auth()->id(),
        ]);

        $reply->commentable()->associate($comment->commentable);
        $reply->save();

        $this->reset(['body']);

    }
}
