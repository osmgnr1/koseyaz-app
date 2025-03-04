<?php

namespace App\Livewire;

use App\Livewire\Forms\CommentForm;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\CornerPost;
use Livewire\WithPagination;

class Comments extends Component
{
    use AuthorizesRequests;
    public Model $model;
    public CommentForm $form;

    public function postComment()
    {
        $this->form->storeComment($this->model);

    }

    // Whenever deleteComment event will be dispatched, and the code below listens for that event, so deleteComment method here will be executed.
    #[On('deleteComment')]
    public function deleteComment($comment_id)
    {

        $comment = Comment::find($comment_id);

        $this->authorize('delete', $comment);

        $comment->delete();

    }


    // #[On('reply-added')]
    public function render()
    {
        return view('livewire.comments', [
            'comments' => $this->model
            ->comments()
            ->with('user', 'replies.user', 'replies.replies')
            ->parent()
            ->latest()
            ->paginate(100),
            'count' => $this->model->commentCount()
        ]);
    }
}
