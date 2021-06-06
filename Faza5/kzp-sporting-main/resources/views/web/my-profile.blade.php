@extends('web.layout.master')

@section('title')
    <title>Moj profil</title>
@endsection

@section('content')
    <div class="row container justify-content-center">
        <div class="col-xl-6 col-md-12">
            <div class="card user-card-full">
                <div class="row m-l-0 m-r-0">
                    <div class="col-sm-4 bg-c-lite-green user-profile">
                        <div class="card-block text-center text-white">
                            <div class="m-b-25"><img src="{{ asset('assets/front/images/ver-avatar.png') }}"
                                                     class="img-fluid" style="size: 50px;"
                                                     alt="Ime-Prezime"></div>
                            <h6 class="f-w-600">{{ auth()->guard('customer')->user()->user->name . ' ' . auth()->guard('customer')->user()->user->surname }}</h6>
                            <p>Korisnik</p> <i class=" mdi mdi-square-edit-outline feather icon-edit m-t-10 f-16"></i>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="card-block">
                            <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Informacije</h6>
                            <div class="row">
                                <div class="col-sm-6">
                                    <p class="m-b-10 f-w-600">Email</p>
                                    <h6 class="text-muted f-w-400">{{ auth()->guard('customer')->user()->email }}</h6>
                                </div>
                                <div class="col-sm-6">
                                    <p class="m-b-10 f-w-600">Telefon</p>
                                    <h6 class="text-muted f-w-400">{{ auth()->guard('customer')->user()->contact }}</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <p class="m-b-10 f-w-600">Korisnicko ime</p>
                                    <h6 class="text-muted f-w-400">{{ auth()->guard('customer')->user()->user->username }}</h6>
                                </div>
                                <div class="col-sm-6">
                                    <p class="m-b-10 f-w-600">Datum rodjenja</p>
                                    <h6 class="text-muted f-w-400">{{ auth()->guard('customer')->user()->date_of_birth }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
