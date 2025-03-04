<?php

namespace App\Models\Presenters;

use App\Models\Comment;

class CommentPresenter{

    public function __construct(
        public Comment $comment

        )
    {
        //Since we write inside __construct (as public) we dont have mention comment model here.
        //$this->comment = $comment;
    }



    public function relativeCreatedAt()
    {
        return $this->comment->created_at->diffForHumans();
    }


}





?>
