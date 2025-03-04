<?php

namespace App\Http\Controllers;

use App\Http\Requests\CornerPostRequest;
use App\Http\Requests\CornerPostUpdateRequest;
use App\Jobs\CornerPostCreateJob;
use App\Jobs\CornerPostDeleteJob;
use App\Jobs\CornerPostUpdateJob;
use App\Models\Category;
use App\Models\Comment;
use App\Models\CornerPost;
use App\Models\Like;
use App\Models\Tag;
use App\Models\TagApp;
use DOMDocument;
use Illuminate\Bus\Batch;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Throwable;

class DashboardController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function cornerpost_create()
    {
        $this->authorize('create', CornerPost::class);
        $categories = Category::all()->sortBy('name');
        $tags = Tag::all()->sortBy('name');
        return view('cornerposts.user.createNew', ['categories' => $categories, 'tagsdb' => $tags]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function cornerpost_store(CornerPostRequest $request)
    {
        // dd($request);
        $this->authorize('create', CornerPost::class);
        // dd($request);
        $tags_saving = $request->validated()['tags'];

        foreach ($tags_saving as $key => $value) {

            if (is_numeric($value)) {
                continue;
            }

            if(Tag::where('name',$value)->exists()){
                $tags_saving[$key] = Tag::where('name',$value)->first('id')->toArray()['id'];
            }else {

                $tag = Tag::firstOrCreate(['name' => $value]);
                $tags_saving[$key] = $tag->id;

            };

        }

        $contentType = '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">';

        $dom = new DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($contentType.$request->body, 9);

        $images = $dom->getElementsByTagName('img');

        $images_array = [];

        foreach ($images as $key => $img) {
            $data = base64_decode(explode(',', explode(';', $img->getAttribute('src'))[1])[1]);
            // $image_name = "/upload/" . time() . $key . '.png';
            $image_name = "/userImageUploads/" . time() . $key . '.png';

            $images_array [] = $image_name;
            file_put_contents(Storage::disk('public')->path('').$image_name, $data);

            $img->removeAttribute('src');
            $img->setAttribute('src', $image_name);
        }


        $body = $dom->saveHTML();
        $title = $request->validated('title');
        $category_id = $request->validated('category_id');
        $images_ = implode(";",$images_array);

        $user_id = Auth::user()->id;

        // dd($user_id);

        $cornerpost_data = ['user_id' => $user_id, 'title' => $title, 'body' => $body, 'category_id' => $category_id, 'images' => $images_];

        // $data = [
        //     'data' => $cornerpost_data,
        //     'tags' => $tags_saving
        // ];

        // CornerPostCreateJob::dispatch($data);
        // sleep(2);

        $cornerpost_created = CornerPost::create($cornerpost_data);

        foreach ($tags_saving as $value) {
            TagApp::create([
                'corner_post_id' => $cornerpost_created->id,
                'tag_id' => $value
            ]);
        }




        return redirect()->route('dashboard.cornerposts')->with('success', 'Köşe yazısı başarıyla oluşturuldu.');

    }


    public function cornerpost_update(CornerPost $cornerpost)
    {

        $this->authorize('update_view', $cornerpost);

        $categories = Category::all()->sortBy('name');
        $tags = Tag::all()->sortBy('name');
        return view('cornerposts.user.updateNew', ['categories' => $categories, 'tagsdbup' => $tags, 'cornerpost' => $cornerpost]);

    }

    public function cornerpost_update_store(CornerPostUpdateRequest $cornerPostUpdateRequest)
    {

        $id = $cornerPostUpdateRequest->id;
        $cornerpost = CornerPost::find($id);

        $this->authorize('update', $cornerpost);

        // dd(File::exists(public_path($images_deleted_array[1])));

        // dd($images_deleted_array);

        $tags_saving = $cornerPostUpdateRequest->validated()['tags'];

        foreach ($tags_saving as $key => $value) {

            if (is_numeric($value)) {
                continue;
            }

            if(Tag::where('name',$value)->exists()){
                $tags_saving[$key] = Tag::where('name',$value)->first('id')->toArray()['id'];

            }else {
                $tag = Tag::firstOrCreate(['name' => $value]);
                $tags_saving[$key] = $tag->id;

            };

        }

        $dom = new DOMDocument();

        libxml_use_internal_errors(true);
        $dom->loadHTML($cornerPostUpdateRequest->body);
        $images = $dom->getElementsByTagName('img');

        // foreach ($images_deleted_array as $key => $path) {

        //     // $path =Str::of($src)->after('/');

        //     if (File::exists(public_path($path))) {
        //         File::delete(public_path($path));
        //     }
        // }

        // $images_array = explode(';', $cornerpost->images);

        foreach ($images as $key => $img) {

            //Check if the image is a new one
            if (strpos($img->getAttribute('src'), 'data:image/') === 0) {

                $data = base64_decode(explode(',', explode(';', $img->getAttribute('src'))[1])[1]);
                // $image_name = "/upload/" . time() . $key . '.png';
                // file_put_contents(public_path().$image_name, $data);

                $image_name = "/userImageUploads/" . time() . $key . '.png';
                // $images_array [] = $image_name;
                file_put_contents(Storage::disk('public')->path('').$image_name, $data);

                $img->removeAttribute('src');
                $img->setAttribute('src', $image_name);
            }
        }

        $body = $dom->saveHTML();
        // $images_ = implode(";",$images_array);

        $cornerpost_data= [
            'id' => $id,
            'title' => $cornerPostUpdateRequest->validated('title'),
            'body' => $body,
            'category_id' => $cornerPostUpdateRequest->validated('category_id'),
            // 'images' => $images_,
            'published_at' => null,
            'tags' => $tags_saving
        ];

        // CornerPostUpdateJob::dispatch($cornerpost_data);
        // sleep(2);

        $cornerpost = CornerPost::find($cornerpost_data['id']);
        $cornerpost->title = $cornerpost_data['title'];
        $cornerpost->body = $cornerpost_data['body'];
        $cornerpost->category_id = $cornerpost_data['category_id'];
        // $cornerpost->images = $cornerpost_data['images'];
        $cornerpost->published_at = $cornerpost_data['published_at'];
        $cornerpost->save();

        $tags = $cornerpost_data['tags'];

        TagApp::where('corner_post_id', $cornerpost_data['id'])->delete();

        foreach ($tags as $value) {
            TagApp::create([
                'corner_post_id' => $cornerpost_data['id'],
                'tag_id' => $value
            ]);
        }

        return redirect()->route('dashboard.cornerposts')->with('success', 'Köşe yazısı başarıyla güncellendi.');

    }


    public function cornerpost_delete(Request $request)
    {
        $id = $request->id;
        $cornerpost = CornerPost::find($id);
        $this->authorize('delete', $cornerpost);

        CornerPostDeleteJob::dispatch($cornerpost);

        return redirect()->back()->with('success', 'Köşe yazısı başarıyla silindi');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function dashboard()
    {
        $values = auth()->user()->myStatistics();
        // dd($values);
        return view('dashboard', ['values' => $values]);
    }

    public function cornerposts()
    {
        return view('cornerposts.user.index', ['cornerposts'=>auth()->user()->cornerPosts()->latest()->get()]);
    }


    public function cornerposts_i_like()
    {

        $cornerposts_ids = Like::where('user_id', auth()->user()->id)->get('corner_post_id')->toArray();
        $cornerposts = CornerPost::whereIn('id',$cornerposts_ids)->get();

        return view('cornerposts.user.my-like-cornerposts', ['cornerposts' => $cornerposts]);
    }

    public function cornerposts_mycomments()
    {

        $cornerposts_ids = Comment::where('user_id', auth()->user()->id)->get('commentable_id')->toArray();
        // dd($cornerposts_ids);
        $cornerposts = CornerPost::whereIn('id',$cornerposts_ids)->get();

        return view('cornerposts.user.my-comments-cornerposts', ['cornerposts' => $cornerposts]);
    }

    public function likes_and_comments(){

        $user = auth()->user();
        $notifications = $user->notifications()->get();
        $new_notify_count = $user->unreadNotifications()->count();

        // dd($count);

        $user->unreadNotifications->markAsRead();

        return view('cornerposts.user.comments_and_likes', ['notifications' => $notifications, 'count' => $new_notify_count]);

    }

}
