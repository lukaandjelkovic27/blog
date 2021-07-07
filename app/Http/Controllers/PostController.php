<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\StorePost;
use App\Http\Requests\Post\UpdatePost;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin')->except('index', 'show');
    }

    public function index()
    {
        // Get all posts ordered by updated at
        $posts = Post::orderBy('updated_at', 'DESC')->paginate(3);
        return view('post.index')->with('posts', $posts);
    }

    public function create()
    {
        return view('post.create');
    }

    public function store(StorePost $request)
    {
        try {
            $post = new Post;
            $post->fill($request->all());
            $post->user()->associate(auth()->user());
            $post->save();
            // Image upload
            $newImageName = uniqid() . '-' . $request->title . '.' . $request->image->extension();
            $request->file('image')->storeAs('images', $newImageName, 'public');
            $post->image_path = $newImageName;

            $post->update();
            return redirect(route('posts.index'))->with('message', 'Post successfully added');
        } catch (\Exception $e){
            return back()->withErrors($e->getMessage());
        }
    }

    public function show(Post $post)
    {
        return view('post.show')->with('post', $post->load('comments'));
    }

    public function edit(Post $post)
    {
        $postId = Post::where('id', $post->id)->first();
        return view('post.edit')->with('post', $postId);
    }

    public function update(UpdatePost $request, Post $post)
    {
        try {
            $post->fill($request->all());
            if ($request->has('image')) {
                $newImageName = uniqid() . '-' . $request->title . '.' . $request->image->extension(); //kako da obrisem staru sliku
                $request->file('image')->storeAs('images', $newImageName, 'public');
                $post->image_path = $newImageName;
            }
            $post->update();

            return redirect(route('posts.index'))->with('message', 'Post updated successfully');
        } catch (\Exception $e){
            return back()->withErrors($e->getMessage());
        }
    }

    public function destroy(Post $post)
    {
        try {
            $post->delete();
            return redirect(route('posts.index'))->with('message', 'Post deleted successfully');
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }
}
