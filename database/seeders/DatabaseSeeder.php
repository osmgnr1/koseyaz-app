<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Comment;
use App\Models\CornerPost;
use App\Models\Like;
use App\Models\Tag;
use App\Models\TagApp;
use App\Models\User;
use App\Models\Viewer;
use Database\Factories\TagAppFactory;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $categories = Category::factory(5)->create();
        $tags = Tag::factory(10)->create();

        User::factory(5)->create();
        $users = User::all()->shuffle();

        for ($i = 0; $i < 10; $i++) {

            $tags = Tag::inRandomOrder()->take(rand(2, 5))->get();
            $user_id = $users->random()->id;
            $category_id = $categories->random()->id;

            $cornerpost = CornerPost::factory()->create([
                'user_id' => $user_id,
                'category_id' => $category_id,

            ]);

            foreach ($tags as $tag) {
                TagApp::factory()->create([
                    'corner_post_id' => $cornerpost->id,
                    'tag_id' => $tag->id
                ]);
            }
        }

        $corner_posts = CornerPost::all();
        for ($i = 0; $i < 20; $i++) {
            Like::factory()->create([
                'user_id' => $users->random()->id,
                'corner_post_id' => $corner_posts->random()->id,
            ]);

            Viewer::factory()->create([
                'user_id' => $users->random()->id,
                'corner_post_id' => $corner_posts->random()->id,
            ]);
        }


    }
}
