@extends('moderator.layout.master')

@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-auto">
                            <h6 class="card-title">Reservations</h6>
                        </div>
                    </div>
                    <table class="table responsive-table table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Customer</th>
                            <th>Category</th>
                            <th>Created Reservation</th>
                            <th>Appointment Date</th>
                            <th>Time Start</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($list as $item)
                            <tr>
                                <th>{{$item->id}}</th>
                                <th>{{$item->customer->user->username}}</th>
                                <th>{{$item->appointment->category->type}}</th>
                                <th>{{$item->date_of_reservation}}</th>
                                <th>{{$item->appointment->appointment_date}}</th>
                                <th>{{$item->appointment->time_start}}</th>
                                <th>
                                    @if($item->status == 0)
                                        Waiting
                                    @endif
                                    @if($item->status == 1)
                                        Rejected
                                    @endif
                                    @if($item->status == 2)
                                        Accepted
                                    @endif
                                </th>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                            Options
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item"
                                               href="{{route('moderator.reservations.update', ['reservation' => $item->id, 'status' => 2])}}">Accept</a>
                                            <a class="dropdown-item"
                                               href="{{route('moderator.reservations.update', ['reservation' => $item->id, 'status' => 1])}}">Reject</a>
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
