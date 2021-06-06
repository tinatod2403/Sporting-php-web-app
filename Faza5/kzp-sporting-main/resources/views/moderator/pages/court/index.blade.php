@extends('moderator.layout.master')

@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-auto">
                            <h6 class="card-title">Courts</h6>
                        </div>
                    </div>
                    <table class="table responsive-table table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Customer</th>
                            <th>Rating</th>
                            <th>Comment</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($list as $item)
                            <tr>
                                <th>{{$item->id}}</th>
                                <th>{{$item->customer->user->username}}</th>
                                <th>{{$item->rating}}</th>
                                <th>{{$item->comment}}</th>
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
