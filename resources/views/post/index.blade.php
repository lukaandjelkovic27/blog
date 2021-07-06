@extends('layouts.app')

@section('content')
    <div class="container-fluid">
            @role('admin')
                <a href="{{route('posts.create')}}"><button class="btn btn-primary">Create new post</button></a>
            @endrole

        @foreach($posts as $post)
            <div class="row">
                <div class="col-sm-4">
                    <div class="post">
                        <div class="post-img-content" style="min-width: 100px">
                            <img src="{{asset('/storage/images/' . $post->image_path)}}" class="post-image" style="width: 100%"/>
                        </div>
                        <div class="content">
                            <div class="card-title">
                                <h3>{{$post->title}}</h3>
                            </div>
                            <div class="author">
                                By <b>{{$post->user->name}}</b> |
                                <time>{{date('jS M Y', strtotime($post->updated_at)) }}</time>
                            </div>
                            <div>
                                {{$post->description}}
                            </div>
                            <div>
                                <a href="{{route('posts.show', $post->id)}}" class="btn btn-warning btn-sm">Read more</a>

                                @role('admin')
                                <a href="/posts/{{$post->id}}/edit" class="btn btn-warning btn-sm">Edit Post</a>

                                <form action="/posts/{{$post->id}}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                                @endrole
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        {{ $posts->links() }}
    </div>
@endsection
