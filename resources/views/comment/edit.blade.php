@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Post</h1>
        <form action="{{route('comments.update', $comment->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <textarea class="form-control" name="body" rows="10" required>{{$comment->body}}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Edit Post</button>
        </form>
    </div>
@endsection
