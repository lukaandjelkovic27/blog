<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Sluggable;

// Todo change post to blog
// Todo use try/catch
class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin')->except('index', 'show');
    }

    public function index()
    {
        // Get all posts ordered by updated at
        $posts = Post::orderBy('updated_at', 'DESC')->get();
        return view('blog.index')->with('posts', $posts);
    }

    public function create()
    {
        return  view('blog.create');
    }

    public function store(Request $request)
    {
        // Todo move to request validation
        $request->validate([
           'title' => 'required',
           'description'=> 'required',
           'image' => 'required|mimes:jpg,png,jpeg|max:2048'
        ]);

        // Todo change file upload
        $newImageName = uniqid() . '-' . $request->title . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $newImageName);

        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);

        // Todo move post create before file upload\
        // Todo use associate instead of create for user relation
        // Uradi create, associate, save -> upload pa update
        Post::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'slug' => $slug,
            'image_path' => $newImageName,
            'user_id' => auth()->user()->id
        ]);

        return redirect('blog')->with('message', 'Post successfully added');
    }

    public function show(Post $post)
    {
        return view ('blog.show')->with('post', $post);
    }

    public function edit($slug)
    {
        // Todo chage slug to Post model
        $slugId = Post::where('slug', $slug)->first();
        return view ('blog.edit')->with('post', $slugId);
    }


    public function update(Request $request, $slug)
    {
        $request->validate([
            'title' => 'required',
            'description'=> 'required',
            'image' => 'required|mimes:jpg,png,jpeg|max:2048'
        ]);

        Post::where('slug', $slug)
            ->update([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'slug' => $slug,
                /*'image_path' => $newImageName,*/
                'user_id' => auth()->user()->id
            ]);

        return redirect('blog')->with('message', 'Post updated successfully');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect('blog')->with('message', 'Post deleted successfully');
    }
}
