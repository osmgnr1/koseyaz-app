<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\CornerPost;
use App\Models\Like;
use DOMDocument;
use DOMNodeList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Laravel\Prompts\SearchPrompt;

class CornerPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currentPage = request()->get('page',1);

        // dd($currentPage);

        $cornerposts = Cache::remember('cornerposts-'.$currentPage,10, function(){
            // sleep(3);
            return CornerPost::with('category')->whereNot('published_at',null)->latest('published_at')->paginate(10);
        });

        return view('cornerposts.index', [
            'cornerposts' => $cornerposts]);
    }

    public function search(SearchRequest $request)
    {


        $filters = $request->only('search','filter');

        if (!isset($filters['search'])) {
            $cornerposts = CornerPost::with('category')->whereNot('published_at',null)->latest('published_at')->paginate(10);
            return view('cornerposts.index', [
                'cornerposts' => $cornerposts]);
        }

        //if we didnt set params, it would be failure a mistake on route. we appended params in view to pagination links()
        $params = array('search' => $filters['search'], 'filter' => $filters['filter']);

        $cornerposts = CornerPost::with(['category','tag','user'])->whereNot('published_at',null)->latest()->filter($filters);
        return view('cornerposts.index')->with([
            'cornerposts' => $cornerposts->paginate(10),
            'params' => $params]
        );

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
    public function show(CornerPost $cornerpost)
    {
        if (!$cornerpost->published_at) {
            return redirect()->back();
        }

        $cornerpost->addViewer($cornerpost->id);

        return view('cornerposts.show', [
            'cornerpost'=> $cornerpost
        ]);
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
