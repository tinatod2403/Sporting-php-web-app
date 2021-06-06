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
                                    Edit Moderator
                                @else
                                    Create Moderator
                                @endif
                            </h6>
                        </div>
                        <div class="col controls-wrapper mt-3 mt-md-0 d-none d-md-block ">
                            <div class="controls d-flex justify-content-center justify-content-md-end">
                                <a href="{{route('admin.moderators.index')}}" class="btn btn-outline-info pull-right mb-3">
                                    <i class="fas fa-long-arrow-alt-left"></i>
                                    <span class="ml-3">Back</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <form
                        action="{{isset($item) ? route('admin.moderators.update', ['moderator' => $item->id]) : route('admin.moderators.store')}}"
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
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                           placeholder="Enter email"
                                           value="{{isset($item) ? $item->email : old('email')}}">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="contact">Contact</label>
                                    <input type="text" class="form-control" id="contact" name="contact"
                                           placeholder="Enter contact"
                                           value="{{isset($item) ? $item->contact : old('contact')}}">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="date_of_birth">Date of birth</label>
                                    <input class="form-control mb-4 mb-md-0" data-inputmask="'alias': 'datetime'"
                                           data-inputmask-inputformat="dd.mm.yyyy." name="date_of_birth"
                                           id="date_of_birth"
                                           value="{{isset($item) ? (isset($item->date_of_birth) ? date('d.m.Y.', strtotime($item->date_of_birth)) : old('date_of_birth')) : old('date_of_birth')}}">
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

@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/inputmask/jquery.inputmask.bundle.min.js') }}"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/inputmask.js') }}"></script>
@endpush
