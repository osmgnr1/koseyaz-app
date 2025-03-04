<?php

namespace App\Http\Controllers;

use App\Models\CornerPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('admin.cornerposts.index', ['cornerposts'=>CornerPost::where('published_at',null)->get()]);
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
    public function check(CornerPost $cornerpost)
    {

        return view('admin.cornerposts.show', [
            'cornerpost'=> $cornerpost
        ]);

    }

    public function publish(CornerPost $cornerpost)
    {
        // $id = $cornerpost->id;
        //CornerPost::withoutTimestamps()->where('id',$cornerpost->id)->update(['published_at' => now()]);

        CornerPost::withoutTimestamps(function () use($cornerpost) {
            $cornerpost_up = CornerPost::find($cornerpost->id);
            $cornerpost_up->published_at = now();
            $cornerpost_up->save();
        });


        return redirect()->route('admin.index')->with('success', 'Köşe yazısı başarıyla yayınlandı');
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
