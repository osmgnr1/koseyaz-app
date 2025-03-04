<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CornerPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Cache::remember('cornerpostsByCategories',10, function(){
            sleep(3);
            return Category::all()->load('cornerposts');
        });

        return view('categories.index', [
            'categories' => $categories]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {

        $category_id = $category->id;
        $category_name = $category->name;
        $currentPage = request()->get('page',1);

        if (isset($category_id)) {

            $cornerposts = Cache::remember($category_name.'-'.$currentPage,10,function() use($category_id){
                sleep(3);
                return CornerPost::with('category')->where('category_id',$category_id)->whereNot('published_at',null)->latest('published_at')->paginate(5);
            });

            // $cornerposts = CornerPost::with('category')->where('category_id',$category_id)->whereNot('published_at',null)->latest('published_at')->paginate(5);
            return view('categories.show', [
                'cornerposts' => $cornerposts,
                'category_name' => $category_name
            ]);
            }
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
}
