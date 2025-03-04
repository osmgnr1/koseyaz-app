<?php

namespace App\Jobs;

use App\Models\CornerPost;
use App\Models\TagApp;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class CornerPostCreateJob implements ShouldQueue
{
    use Queueable;
    protected array $data;
    protected array $tags;

    /**
     * Create a new job instance.
     */
    public function __construct($data)
    {
        $this->data = $data['data'];
        $this->tags = $data['tags'];
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        $cornerpost_created = CornerPost::create($this->data);

        foreach ($this->tags as $value) {
            TagApp::create([
                'corner_post_id' => $cornerpost_created->id,
                'tag_id' => $value
            ]);
        }



    }
}
