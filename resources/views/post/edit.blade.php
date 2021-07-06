@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>Edit Post</h1>
        <form action="{{route('post.update', $post->id)}}" method="POST" enctype="multipart/form-data">

            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="exampleFormControlInput1">Title</label>
                <input type="text" class="form-control" name="title" value="{{$post->title}}" required>
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">About Post</label>
                <textarea class="form-control" name="description" rows="3" required>{{$post->description}}</textarea>
            </div>

           <div class="form-group">
                <label for="exampleFormControlFile1">Upload Image</label>
                <input type="file" class="form-control-file" name="image" required>
            </div>

            <button type="submit" class="btn btn-primary">Edit Post</button>
        </form>
    </div>
@endsection
