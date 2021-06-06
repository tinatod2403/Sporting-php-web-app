@extends('moderator.layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet"/>
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-auto">
                            <h6 class="card-title">
                                Edit Complex
                            </h6>
                        </div>
                        <div class="col controls-wrapper mt-3 mt-md-0 d-none d-md-block ">
                            <div class="controls d-flex justify-content-center justify-content-md-end">
                                <a href="{{route('moderator.dashboard')}}" class="btn btn-outline-info pull-right mb-3">
                                    <i class="fas fa-long-arrow-alt-left"></i>
                                    <span class="ml-3">Back to Dashboard</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <form
                        action="{{ route('moderator.complexes.update', ['complex' => $item->id]) }}"
                        method="POST" class="forms-sample needs-validation" novalidate enctype="multipart/form-data">
                        @csrf
                        {{ method_field('PATCH') }}
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                           placeholder="Enter name"
                                           value="{{ $item->name }}">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="content">Content</label>
                                    <textarea class="form-control" id="content" name="content"
                                              rows="5">{{ $item->content }}</textarea>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="categories">Category</label>
                                    <select class="js-example-basic-single w-100" id="categories" name="categories[]"
                                            multiple="multiple">
                                        @foreach($categories as $category)
                                            <option
                                                value="{{$category->id}}" {{ in_array($category->id, $complexCategories) ? 'selected' : '' }}>
                                                {{ $category->type }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="logo">Logo upload</label>
                                    <div class="custom-file">
                                        <input type="file" name="logo" class="custom-file-input" id="logo">
                                        <label class="custom-file-label" for="logo">Choose logo</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="images">Images upload</label>
                                    <div class="custom-file">
                                        <input type="file" name="images[]" class="custom-file-input" id="images"
                                               multiple>
                                        <label class="custom-file-label" for="images">Choose images</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @if($item->logo)
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="logo">Logo</label>
                                        <div class="row mt-3 mb-3">
                                            <div class="col-3">
                                                <img
                                                    src="{{ \Illuminate\Support\Facades\Storage::url($item->logo) }}"
                                                    alt="image" style="width:100px; height:100px;"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if(!empty($item->images))
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="logo">Images</label>
                                        <div class="row mt-3 mb-3">
                                            @foreach($item->images as $image)
                                                <div class="col-3 ml-2 mr-2">
                                                    <img
                                                        src="{{ \Illuminate\Support\Facades\Storage::url($image) }}"
                                                        alt="image" style="width:100px; height:100px;"/>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <hr>
                        <h5 class="text-center">Working Hours</h5>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="day_1_name">Day</label>
                                    <input type="text" class="form-control" id="day_1_name" name="days[1][name]"
                                           placeholder="Enter name" readonly value="Monday">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="day_1_open">Open hour</label>
                                    <input class="form-control mb-4 mb-md-0" data-inputmask="'alias': 'datetime'"
                                           data-inputmask-inputformat="HH:MM" name="days[1][open]"
                                           id="day_1_open" required
                                           value="{{$days['Monday']['open'] ?? "" }}">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="day_1_close">Close hour</label>
                                    <input class="form-control mb-4 mb-md-0" data-inputmask="'alias': 'datetime'"
                                           data-inputmask-inputformat="HH:MM" name="days[1][close]"
                                           id="day_1_close" required
                                           value="{{$days['Monday']['close'] ?? "" }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="day_2_name">Day</label>
                                    <input type="text" class="form-control" id="day_2_name" name="days[2][name]"
                                           placeholder="Enter name" readonly value="Tuesday">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="day_2_open">Open hour</label>
                                    <input class="form-control mb-4 mb-md-0" data-inputmask="'alias': 'datetime'"
                                           data-inputmask-inputformat="HH:MM" name="days[2][open]"
                                           id="day_2_open" required
                                           value="{{$days['Tuesday']['open'] ?? "" }}">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="day_2_close">Close hour</label>
                                    <input class="form-control mb-4 mb-md-0" data-inputmask="'alias': 'datetime'"
                                           data-inputmask-inputformat="HH:MM" name="days[2][close]"
                                           id="day_2_close" required
                                           value="{{$days['Tuesday']['close'] ?? "" }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="day_3_name">Day</label>
                                    <input type="text" class="form-control" id="day_3_name" name="days[3][name]"
                                           placeholder="Enter name" readonly value="Wednesday">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="day_3_open">Open hour</label>
                                    <input class="form-control mb-4 mb-md-0" data-inputmask="'alias': 'datetime'"
                                           data-inputmask-inputformat="HH:MM" name="days[3][open]"
                                           id="day_3_open" required
                                           value="{{$days['Wednesday']['open'] ?? "" }}">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="day_3_close">Close hour</label>
                                    <input class="form-control mb-4 mb-md-0" data-inputmask="'alias': 'datetime'"
                                           data-inputmask-inputformat="HH:MM" name="days[3][close]"
                                           id="day_3_close" required
                                           value="{{$days['Wednesday']['close'] ?? "" }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="day_4_name">Day</label>
                                    <input type="text" class="form-control" id="day_4_name" name="days[4][name]"
                                           placeholder="Enter name" readonly value="Thursday">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="day_4_open">Open hour</label>
                                    <input class="form-control mb-4 mb-md-0" data-inputmask="'alias': 'datetime'"
                                           data-inputmask-inputformat="HH:MM" name="days[4][open]"
                                           id="day_4_open" required
                                           value="{{$days['Thursday']['open'] ?? "" }}">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="day_4_close">Close hour</label>
                                    <input class="form-control mb-4 mb-md-0" data-inputmask="'alias': 'datetime'"
                                           data-inputmask-inputformat="HH:MM" name="days[4][close]"
                                           id="day_4_close" required
                                           value="{{$days['Thursday']['close'] ?? "" }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="day_5_name">Day</label>
                                    <input type="text" class="form-control" id="day_5_name" name="days[5][name]"
                                           placeholder="Enter name" readonly value="Friday">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="day_5_open">Open hour</label>
                                    <input class="form-control mb-4 mb-md-0" data-inputmask="'alias': 'datetime'"
                                           data-inputmask-inputformat="HH:MM" name="days[5][open]"
                                           id="day_5_open" required
                                           value="{{$days['Friday']['open'] ?? "" }}">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="day_5_close">Close hour</label>
                                    <input class="form-control mb-4 mb-md-0" data-inputmask="'alias': 'datetime'"
                                           data-inputmask-inputformat="HH:MM" name="days[5][close]"
                                           id="day_5_close" required
                                           value="{{$days['Friday']['close'] ?? "" }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="day_6_name">Day</label>
                                    <input type="text" class="form-control" id="day_6_name" name="days[6][name]"
                                           placeholder="Enter name" readonly value="Saturday">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="day_6_open">Open hour</label>
                                    <input class="form-control mb-4 mb-md-0" data-inputmask="'alias': 'datetime'"
                                           data-inputmask-inputformat="HH:MM" name="days[6][open]"
                                           id="day_6_open" required
                                           value="{{$days['Saturday']['open'] ?? "" }}">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="day_6_close">Close hour</label>
                                    <input class="form-control mb-4 mb-md-0" data-inputmask="'alias': 'datetime'"
                                           data-inputmask-inputformat="HH:MM" name="days[6][close]"
                                           id="day_6_close" required
                                           value="{{$days['Saturday']['close'] ?? "" }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="day_7_name">Day</label>
                                    <input type="text" class="form-control" id="day_7_name" name="days[7][name]"
                                           placeholder="Enter name" readonly value="Sunday">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="day_7_open">Open hour</label>
                                    <input class="form-control mb-4 mb-md-0" data-inputmask="'alias': 'datetime'"
                                           data-inputmask-inputformat="HH:MM" name="days[7][open]"
                                           id="day_7_open" required
                                           value="{{$days['Sunday']['open'] ?? "" }}">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="day_7_close">Close hour</label>
                                    <input class="form-control mb-4 mb-md-0" data-inputmask="'alias': 'datetime'"
                                           data-inputmask-inputformat="HH:MM" name="days[7][close]"
                                           id="day_7_close" required
                                           value="{{$days['Sunday']['close'] ?? "" }}">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">
                            {{ 'Save change' }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/inputmask/jquery.inputmask.bundle.min.js') }}"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/select2.js') }}"></script>
    <script src="{{ asset('assets/js/inputmask.js') }}"></script>
@endpush
