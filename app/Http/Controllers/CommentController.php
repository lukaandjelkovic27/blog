<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comment\StoreComment;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('my.comment')->only('destroy', 'update', 'edit');
    }

    public function store(StoreComment $request)
    {
        try {
            $comment = new Comment;
            $comment->fill($request->all());
            $comment->user()->associate(auth()->user());
            $comment->post()->associate($request->get('post_id'));
            $comment->save();
            return back()->with('message', 'Comment posted successfully');
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    public function edit(Comment $comment)
    {
        $commentId = Comment::where('id', $comment->id)->first();
        return view('comment.edit')->with('comment', $commentId);
    }

    public function update(Request $request, Comment $comment)
    {
        try{
            $comment->fill($request->all());
            $comment->update();
            return redirect(route('posts.show', $comment->post_id))->with('message', 'Post edited');
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    public function destroy(Comment $comment)
    {
        try {
            $comment->delete();
            return back();
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }
}
