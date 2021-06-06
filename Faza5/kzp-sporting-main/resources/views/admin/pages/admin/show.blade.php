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
                                    Edit Admin
                                @else
                                    Create Admin
                                @endif
                            </h6>
                        </div>
                        <div class="col controls-wrapper mt-3 mt-md-0 d-none d-md-block ">
                            <div class="controls d-flex justify-content-center justify-content-md-end">
                                <a href="{{route('admin.admins.index')}}" class="btn btn-outline-info pull-right mb-3">
                                    <i class="fas fa-long-arrow-alt-left"></i>
                                    <span class="ml-3">Back</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <form
                        action="{{isset($item) ? route('admin.admins.update', ['admin' => $item->id]) : route('admin.admins.store')}}"
                        method="POST" class="forms-sample needs-validation" novalidate enctype="multipart/form-data">
                        @csrf
                        {{ isset($item) ? method_field('PATCH') :'' }}
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                           placeholder="Enter name"
                                           value="{{isset($item) ? $item->user->name : old('name')}}">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="surname">Surname</label>
                                    <input type="text" class="form-control" id="surname" name="surname"
                                           placeholder="Enter surname"
                                           value="{{isset($item) ? $item->user->surname : old('surname')}}">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" id="username" name="username"
                                           placeholder="Enter username"
                                           value="{{isset($item) ? $item->user->username : old('username')}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password"
                                           placeholder="Enter Password">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="password_confirmation">Password confirmation</label>
                                    <input type="password" class="form-control" id="password_confirmation"
                                           name="password_confirmation" placeholder="Enter password confirmation">
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
