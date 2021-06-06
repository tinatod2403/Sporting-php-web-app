@extends('moderator.layout.master')

@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-auto">
                            <h6 class="card-title">
                                @if(isset($item))
                                    Edit News
                                @else
                                    Create News
                                @endif
                            </h6>
                        </div>
                        <div class="col controls-wrapper mt-3 mt-md-0 d-none d-md-block ">
                            <div class="controls d-flex justify-content-center justify-content-md-end">
                                <a href="{{route('moderator.news.index')}}"
                                   class="btn btn-outline-info pull-right mb-3">
                                    <i class="fas fa-long-arrow-alt-left"></i>
                                    <span class="ml-3">Back</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <form
                        action="{{isset($item) ? route('moderator.news.update', ['news' => $item->id]) : route('moderator.news.store')}}"
                        method="POST" class="forms-sample needs-validation" novalidate enctype="multipart/form-data">
                        @csrf
                        {{ isset($item) ? method_field('PATCH') :'' }}
                        <div class="row">
                            <div class="col-9">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                           placeholder="Enter title"
                                           value="{{isset($item) ? $item->title : old('title')}}">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="type">Type</label>
                                    <select id="type" name="type">
                                        <option
                                            value="news" {{(isset($item) && $item->type == 'news') || old('type') == 'news' ? 'selected' : '' }}>
                                            News
                                        </option>
                                        <option
                                            value="promotions" {{(isset($item) && $item->type == 'promotions') || old('type') == 'promotions' ? 'selected' : '' }}>
                                            Promotions
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="content">Content</label>
                                    <textarea class="form-control" id="content" name="content"
                                              rows="5">{{isset($item) ? $item->content : old('content')}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="image">Image upload</label>
                                    <div class="custom-file">
                                        <input type="file" name="image" class="custom-file-input" id="image">
                                        <label class="custom-file-label" for="image">Choose image</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if(isset($item))
                            <div class="row mt-3 mb-3">
                                <div class="col-3">
                                    <img src="{{ \Illuminate\Support\Facades\Storage::url($item->path_image) }}"
                                         alt="image" style="max-width:150px"/>
                                </div>
                            </div>
                        @endif
                        <button type="submit" class="btn btn-primary mr-2">
                            {{isset($item) ? 'Save change' : 'Save'}}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
