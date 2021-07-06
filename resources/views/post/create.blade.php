@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>Create Post</h1>
        <form action="{{route('posts.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="exampleFormControlInput1">Title</label>
                <input type="text" class="form-control" name="title" required>
            </div>


            <div class="form-group">
                <label for="exampleFormControlTextarea1">About Post</label>
                <textarea class="form-control" name="description" rows="3" required></textarea>
            </div>

            <div class="form-group">
                <label for="exampleFormControlFile1">Upload Image</label>
                <input type="file" class="form-control-file" name="image" required>
            </div>

            <button type="submit" class="btn btn-primary">Create Post</button>
        </form>
    </div>


@endsection
