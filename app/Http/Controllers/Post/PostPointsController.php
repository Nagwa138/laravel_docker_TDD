<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostPoint;
use Illuminate\Http\Request;

class PostPointsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request,Post $post)
    {

        if(auth()->user()->isNot($post->owner)){
            abort(403);
        }

       request()->validate([
            'body' => 'required'
       ]);

        $post->addPoint(request('body'));

        return redirect($post->path());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PostPoint  $postPoint
     * @return \Illuminate\Http\Response
     */
    public function show(PostPoint $postPoint)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PostPoint  $postPoint
     * @return \Illuminate\Http\Response
     */
    public function edit(PostPoint $postPoint)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PostPoint  $postPoint
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PostPoint $postPoint)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PostPoint  $postPoint
     * @return \Illuminate\Http\Response
     */
    public function destroy(PostPoint $postPoint)
    {
        //
    }
}
