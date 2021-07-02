@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="post-img-content" style="min-width: 100px" >
            <img src="{{asset('images/' . $post->image_path)}}" class="post-image" style="
            width: 100%"/>
        </div>
        <h3>{{$post->title}}</h3>
        <span>Created by {{$post->user->name}} | {{date('jS M Y', strtotime($post->updated_at)) }}</span>
        <p>{{$post->description}}</p>
    </div>

    <div class="container mb-5 mt-5">
        <div class="card">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="text-center mb-5"> Comment Section </h3>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="media">
                                <div class="media-body">
                                    <div class="row">
                                        <div class="col-8 d-flex">
                                            <h5>Maria Smantha</h5> <span>- 2 hours ago</span>
                                        </div>
                                        <div class="col-4">
                                            <div class="pull-right reply"> <a href="#"><span><i class="fa fa-reply"></i> reply</span></a> </div>
                                        </div>
                                    </div> It is a long established fact that a reader will be distracted by the readable content of a page. <div class="media mt-4"> <a class="pr-3" href="#"></a>
                                        <div class="media-body">
                                            <div class="row">
                                                <div class="col-12 d-flex">
                                                    <h5>Simona Disa</h5> <span>- 3 hours ago</span>
                                                </div>
                                            </div> letters, as opposed to using 'Content here, content here', making it look like readable English.
                                        </div>
                                    </div>
                                    <div class="media mt-3"> <a class="pr-3" href="#"></a>
                                        <div class="media-body">
                                            <div class="row">
                                                <div class="col-12 d-flex">
                                                    <h5>John Smith</h5> <span>- 4 hours ago</span>
                                                </div>
                                            </div> the majority have suffered alteration in some form, by injected humour, or randomised words.
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
