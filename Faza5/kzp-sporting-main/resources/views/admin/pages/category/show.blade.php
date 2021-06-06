@extends('admin.layout.master')

@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-auto">
                            <h6 class="card-title">
                                @if(isset($item))
                                    Edit Category
                                @else
                                    Create Category
                                @endif
                            </h6>
                        </div>
                        <div class="col controls-wrapper mt-3 mt-md-0 d-none d-md-block ">
                            <div class="controls d-flex justify-content-center justify-content-md-end">
                                <a href="{{route('admin.categories.index')}}" class="btn btn-outline-info pull-right mb-3">
                                    <i class="fas fa-long-arrow-alt-left"></i>
                                    <span class="ml-3">Back</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <form
                        action="{{isset($item) ? route('admin.categories.update', ['category' => $item->id]) : route('admin.categories.store')}}"
                        method="POST" class="forms-sample needs-validation" novalidate enctype="multipart/form-data">
                        @csrf
                        {{ isset($item) ? method_field('PATCH') :'' }}
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="type">Type</label>
                                    <input type="text" class="form-control" id="type" name="type"
                                           placeholder="Enter type"
                                           value="{{isset($item) ? $item->type : old('type')}}">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">
                            {{isset($item) ? 'Save change' : 'Save'}}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
