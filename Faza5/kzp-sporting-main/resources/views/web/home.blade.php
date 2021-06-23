@extends('web.layout.master')

@section('title')
    <title>Pocetna</title>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12 centar"
             style="background-image: url({{ asset('assets/front/images/pozadina.jpg') }});"></div>
    </div>
    <div class="row">
        <div class="col-sm-12 banner">
            <div>
                <img class="banner-bg" src="{{ asset('assets/front/images/header.jpg') }}">
            </div>
            <div class="banner-content">
                <h6 class="banner-tekst">PRONAĐI NOVE LOKACIJE,<br> ZAKAŽITE VAŠ TERMIN!</h6>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 text-justify slide-sports">
            <ul class="slide-sport-ul">
                <il class="slide-sport-il">
                    <a href="{{ route('category',['category'=>'tenis']) }}">
                        <img class="slide-slike" id="tenis" src="{{ asset('assets/front/images/tenis.jpg') }}">
                    </a>
                </il>
                <il class="slide-sport-il">
                    <a href="{{ route('category',['category'=>'fudbal']) }}">
                        <img class="slide-slike" id="fudbal" src="{{ asset('assets/front/images/fudbal.jpg') }}"
                             href="#">
                    </a>
                </il>
                <il class="slide-sport-il">
                    <a href="{{ route('category',['category'=>'kuglanje']) }}">
                        <img class="slide-slike" id="kuglanje" src="{{ asset('assets/front/images/kuglanje.jpg') }}"
                             href="#">
                    </a>
                </il>
                <il class="slide-sport-il">
                    <a href="{{ route('category',['category'=>'kosarka']) }}">
                        <img class="slide-slike" id="kosarka.jpg"
                             src="{{ asset('assets/front/images/kosarka.jpg') }}"
                             href="#">
                    </a>
                </il>
                <il class="slide-sport-il">
                    <a href="{{ route('category',['category'=>'bilijar']) }}">
                        <img class="slide-slike" id="bilijar.jpg"
                             src="{{ asset('assets/front/images/bilijar.jpg') }}"
                             href="#">
                    </a>
                </il>
                <il class="slide-sport-il">
                    <a href="{{ route('category',['category'=>'odbojka']) }}">
                        <img class="slide-slike" id="odbojka.jpg"
                             src="{{ asset('assets/front/images/odbojka.jpg') }}"
                             href="#">
                    </a>
                </il>
                <il class="slide-sport-il">
                    <a href="{{ route('category',['category'=>'jahanje']) }}">
                        <img class="slide-slike" id="jahanje.jpg"
                             src="{{ asset('assets/front/images/jahanje.jpg') }}"
                             href="#">
                    </a>
                </il>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 banner">
            <div>
                <img class="banner-bg-novosti" src="{{ asset('assets/front/images/header.jpg') }}">
            </div>
            <div class="banner-content">
                <h6 class="banner-tekst">NOVOSTI</h6>
            </div>
        </div>
    </div>
    <!-- NOVOSTI -->
    <div class="row">
        @foreach($news as $newsItem)
            <div class="col-sm-4">
                <div id="novosti-1" class="novosti">
                    <a href="{{ route('news',['news'=>$newsItem->id]) }}">
                        <table>
                            <tr>
                                <td colspan="2" stayle="margin:0; ">
                                    <img src="{{ \Illuminate\Support\Facades\Storage::url($newsItem->path_image) }}"
                                         class="img-fluid novosti-slika">
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: center; ">
                                    <p id="novosti-datum-2" style="color: rgba(78, 148, 119, 1)">
                                        <b>{{ date('d.m.Y.', strtotime($newsItem->created_at)) }}</b></p>
                                </td>

                                <td>
                                    <h3 style="color: rgba(78, 148, 119, 1)"><b>
                                            <v-r></v-r> &nbsp; {{ $newsItem->title }}</b></h3>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <p>{{ \Illuminate\Support\Str::limit($newsItem->content) }}</p>
                                </td>
                            </tr>
                        </table>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
    <!-- ============ -->
    <div class="row">
        <div class="col-sm-12 banner">
            <div>
                <img class="banner-bg-novosti" src="{{ asset('assets/front/images/header.jpg') }}">
            </div>
            <div class="banner-content">
                <h6 class="banner-tekst">PROMOCIJE</h6>
            </div>
        </div>
    </div>
    <!-- PROMOCIJE -->
    <div class="row">
        @foreach($promotions as $promotionItem)
            <div class="col-sm-4">
                <div id="novosti-1" class="novosti">
                    <a href="{{ route('news',['news'=>$promotionItem->id]) }}">
                        <table>
                            <tr>
                                <td colspan="2" stayle="margin:0; ">
                                    <img
                                        src="{{ \Illuminate\Support\Facades\Storage::url($promotionItem->path_image) }}"
                                        class="img-fluid novosti-slika">
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: center; ">
                                    <p id="novosti-datum-2" style="color: rgba(78, 148, 119, 1)">
                                        <b>{{ date('d.m.Y.', strtotime($promotionItem->created_at)) }}</b></p>
                                </td>

                                <td>
                                    <h3 style="color: rgba(78, 148, 119, 1)"><b>
                                            <v-r></v-r> &nbsp; {{ $promotionItem->title }}</b></h3>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <p>{{ \Illuminate\Support\Str::limit($newsItem->content) }}</p>
                                </td>
                            </tr>
                        </table>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
