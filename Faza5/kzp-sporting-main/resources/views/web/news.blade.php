@extends('web.layout.master')

@section('title')
    <title>Novosti</title>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12 container-nov"
             style="height: 350px; background-image: url({{ \Illuminate\Support\Facades\Storage::url($news->path_image) }});">
            <div class="text-block">
                <h4>{{ $news->title }}</h4>
                <p>{{ $news->content }}</p>
            </div>
        </div>
    </div>
@endsection

