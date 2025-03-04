<?php

namespace App\Jobs;

use App\Models\CornerPost;
use App\Models\TagApp;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class CornerPostUpdateJob implements ShouldQueue
{
    use Queueable;
    protected array $data;

    /**
     * Create a new job instance.
     */
    public function __construct($cornerpost_data)
    {
        $this->data = $cornerpost_data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        $cornerpost = CornerPost::find($this->data['id']);
        $cornerpost->title = $this->data['title'];
        $cornerpost->body = $this->data['body'];
        $cornerpost->category_id = $this->data['category_id'];
        $cornerpost->published_at = $this->data['published_at'];
        $cornerpost->save();

        $tags = $this->data['tags'];

        TagApp::where('corner_post_id', $this->data['id'])->delete();

        foreach ($tags as $value) {
            TagApp::create([
                'corner_post_id' => $this->data['id'],
                'tag_id' => $value
            ]);
        }




    }
}
