<?php

namespace App\Livewire\Forms;

use App\Jobs\CommentCreateJob;
use App\Models\User;
use App\Notifications\UserCommentNotify;
use Illuminate\Database\Eloquent\Model;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CommentForm extends Form
{
    #[Validate('required', message:'Please enter a comment.')]
    public $body;

    public function storeComment(Model $model){

        $this->validate();

        // dd(auth()->user());
        // $user = User::find(auth()->id());
        $user = $model->user;
        $model->comments()->create([
            'body'=> $this->body,
            'user_id' => auth()->id(),
        ]);



        $this->reset(['body']);

        $data = [
            'username' => auth()->user()->username,
            'title' => $model->title,
        ];

        $user->notify(new UserCommentNotify($data));

    }
}
