<?php

namespace App\Http\Controllers;

use App\Like;
use App\Reply;
use Auth;
use phpDocumentor\Reflection\Types\Integer;
use Session;
use App\Discussion;
use Illuminate\Http\Request;

class DiscussionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('discuss');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'channel_id' => 'required',
            'content' => 'required',
            'title' => 'required'
        ]);

        $discussion = Discussion::create([
            'title' => $request->title,
            'content' => request('content'),
            'channel_id' => $request->channel_id,
            'user_id' => Auth::id(),
            'slug' => str_slug($request->title),
        ]);

        Session::flash('success', 'Discussion successfully created.');

        return redirect()->route('discussions.show', ['discussion' => $discussion->slug]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Discussion  $discussion
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $discussion = Discussion::where('slug', $slug)->first();
        return view('discussions.show')
            ->with('discussion', $discussion);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Discussion  $discussion
     * @return \Illuminate\Http\Response
     */
    public function edit(Discussion $discussion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Discussion  $discussion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Discussion $discussion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Discussion  $discussion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Discussion $discussion)
    {
        //
    }

    public function reply(Request $request, $id)
    {
        $this->validate($request, [
            'reply' => 'required|string'
        ]);

        $discussion = Discussion::find($id);

        $reply = Reply::create([
            'user_id' => Auth::id(),
            'discussion_id' => $discussion->id,
            'content' => request('content')
        ]);

        Session::flash('success', 'Reply registered');

        return redirect()->back();
    }

    public function delete($id)
    {
        $reply = Reply::find($id);

        if ($reply->user->id === Auth::id()) {
            $reply->delete();
        }

        return redirect()->back();
    }

    public function like($discussionId, $replyId)
    {
        $reply = Reply::find($replyId);
        if (count($reply) > 0) {
            Like::create([
                'user_id' => Auth::id(),
                'reply_id' => $replyId
            ]);
        }

        return redirect()->back();
    }

    public function unlike($discussionId, $replyId)
    {
        $reply = Reply::find($replyId);
        if (count($reply) > 0) {
            Like::query()->where('user_id', Auth::id())->delete();
        }
        return redirect()->back();
    }
}
