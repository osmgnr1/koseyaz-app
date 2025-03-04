<?php

namespace App\Livewire;

use App\Livewire\Forms\ReplyForm;
use App\Livewire\Forms\UpdateCommentForm;
use App\Models\Comment as CommentModel;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Livewire;

class Comment extends Component
{
    use AuthorizesRequests;
    public $listeners = [
        'deleteComment' => '$refresh',
    ];

    public CommentModel $comment;

    //when buttons will be clicked, then these variables will get true, so related form will be opened.
    public $isReplying = false, $isEditing = false;
    public ReplyForm $form;
    public UpdateCommentForm $updateForm;

    public function storeReply()
    {
        if ($this->comment->isReply()) {
            return;
        }

        $this->form->storeReply($this->comment);
        $this->isReplying = false;
        // $this->dispatch('reply-added');
    }

    public function updateComment(){

        $this->authorize('update', $this->comment);//this part maps to comment policy update method.
        $this->updateForm->updateComment($this->comment);
        $this->isEditing = false;

    }

    public function updatedIsEditing($value)
    {
        if ($value) {
            $this->updateForm->body = $this->comment->body;
        }

    }

    public function render()
    {
        return view('livewire.comment');
    }

}
