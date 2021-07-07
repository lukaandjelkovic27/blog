@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="post-img-content" style="min-width: 100px"  >
            <img src="{{asset('/storage/images/' . $post->image_path)}}" class="post-image" style="
            width: 100%"/>
        </div>
        <h3>{{$post->title}}</h3>
        <span>Created by {{$post->user->name}} | {{date('jS M Y', strtotime($post->updated_at)) }}</span>
        <p>{{$post->description}}</p>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form action="{{route('comments.store')}}" method="POST">
                    @csrf
                    <input name="post_id" type="hidden" value="{{$post->id}}">
                    <textarea name="body" cols="50" rows="10" placeholder="Type your comment"></textarea>
                    <button type="submit">Add comment</button>
                </form>
            </div>
        </div>
    </div>


    <div class="container mb-5 mt-5">
        <h3 class="text-center mb-5"> Comment Section </h3>
        @foreach($post->comments as $comment)
        <div class="card">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="media">
                                <div class="media-body">
                                    <div class="row">
                                        <div class="col-8 d-flex">
                                            <h5>{{$comment->user->name}}</h5> <span>- {{$comment->created_before}}</span>
                                        </div>
                                        <div class="col-4">
                                            @if(auth()->id() === $comment->user_id)
                                                <div>
                                                    <a href="{{route('comments.edit', $comment->id)}}">
                                                        <button class="btn btn-warning btn-sm">Edit comment</button>
                                                    </a>
                                                </div>
                                                <div>
                                                    <form action="{{route('comments.destroy', $comment->id)}}" method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger btn-sm">Delete comment</button>
                                                    </form>
                                                </div>
                                            @endif
                                        </div>
                                    </div> {{$comment->body}} <div class="media mt-4">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
@endsection
