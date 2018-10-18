<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Feed;

class FeedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $feeds = Feed::all();
        return view('index')->with('feeds', $feeds);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $feed = Feed::create($request->input());
        return response()->json($feed);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($feed_id)
    {
        $feed = Feed::find($feed_id);
        return response()->json($feed);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $feed_id)
    {
        $feed = Feed::find($feed_id);
        $feed->url = $request->url;
        $feed->description = $request->description;
        $feed->save();
        return response()->json($feed);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($feed_id)
    {
        $feed = Feed::destroy($feed_id);
        return response()->json($feed);
    }
}
