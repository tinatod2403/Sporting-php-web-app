@extends('moderator.layout.master')

@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-auto">
                            <h6 class="card-title">News</h6>
                        </div>
                        <div class="col controls-wrapper mt-3 mt-md-0 d-none d-md-block ">
                            <div class="controls d-flex justify-content-center justify-content-md-end">
                                <a href="{{route('moderator.news.create')}}"
                                   class="btn btn-outline-info pull-right mb-3">
                                    <i class="link-icon" data-feather="plus-square"></i>
                                    <span class="ml-3">Create news</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <table class="table responsive-table table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Type</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($list as $item)
                            <tr>
                                <th>{{$item->id}}</th>
                                <th>{{$item->title}}</th>
                                <th>{{$item->type}}</th>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                            Options
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item"
                                               href="{{route('moderator.news.edit', ['news' => $item->id])}}">Edit</a>
                                            <form action="{{route('moderator.news.destroy', ['news' => $item->id])}}"
                                                  method="post">
                                                {!! method_field('delete') !!}
                                                @csrf
                                                <button type="submit" class="dropdown-item">
                                                    <span>Delete</span>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{ $list->links() }}
@endsection
