<?php

namespace App\Jobs;

use App\Models\Comment;
use App\Models\CornerPost;
use App\Models\User;
use DOMDocument;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CornerPostDeleteJob implements ShouldQueue
{
    use Queueable;

    protected CornerPost $cornerpost;

    /**
     * Create a new job instance.
     */
    public function __construct($cornerpost)
    {
        $this->cornerpost = $cornerpost;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        $dom = new DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($this->cornerpost->body,9);

        $images = $dom->getElementsByTagName('img');

        foreach ($images as $key => $img) {

            $src = $img->getAttribute('src');
            $path =Str::of($src)->after('/');

            if (File::exists(public_path($path))) {
                File::delete(public_path($path));
            }
        }

        $id = $this->cornerpost->id;
        $user = User::find($this->cornerpost->user_id);

        Comment::where('commentable_id', $id)->delete();
        $user->cornerPosts()->where('id', $id)->with(['tag', 'viewer', 'like'])->delete();

    }
}
