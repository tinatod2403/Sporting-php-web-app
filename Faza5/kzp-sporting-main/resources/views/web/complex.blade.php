@extends('web.layout.master')

@section('title')
    <title>{{ $complex->name }}</title>
@endsection

@section('head')
    <link rel="stylesheet" href="{{ asset('assets/front/css/slide-show.css') }}">
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12 tekst-o-nama" style="margin-top: 20px;">
            <p><i>RADNO VREME: ponedeljak-nedelja</i></p>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 ocena">
            <p><i>Ocena: &#11088; {{ $complex->average_rating }}</i></p>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 tekst-o-nama" style="margin-top: 20px;">
            <p>{{ $complex->content }}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            @if(auth()->guard('customer')->check())
                <a href="{{ route('calendar',['category'=>$category->type,'complex'=>$complex->name]) }}">
                    <button class="button_zakazi"><span>ZAKAZI TERMIN </span></button>
                </a>
            @else
                <a href="#" onclick="document.getElementById('id01').style.display='block'">
                    <button class="button_zakazi"><span>ZAKAZI TERMIN </span></button>
                </a>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="slideshow-container">
                @foreach ($complex->images as $key => $value)
                    <div class="mySlides fadez">
                        <div class="numbertext">{{ $key+1 }} / {{ count($complex->images) }}</div>
                        <img src="{{ \Illuminate\Support\Facades\Storage::url($value) }}" style="width:500px;"/>
                    </div>
            @endforeach

            <!-- Next and previous buttons -->
                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                <a class="next" onclick="plusSlides(1)">&#10095;</a>
            </div>


            <!-- The dots/circles -->
            <div style="text-align:center">
                <span class="dot" onclick="currentSlide(1)"></span>
                <span class="dot" onclick="currentSlide(2)"></span>
                <span class="dot" onclick="currentSlide(3)"></span>
            </div>
        </div>

        <script src="{{ asset('assets/front/js/skript.js') }}"></script>
        <div class="col-sm-6">
            <img src="{{ \Illuminate\Support\Facades\Storage::url($complex->logo) }}"
                 style="width:200px; margin-left: 400px;">
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            @foreach($complex->courts as $court)
                <div class="komentar-cont">
                    <img src="{{ asset('assets/front/images/ver-avatar.png') }}" alt="Avatar" style="width:90px">
                    <p><span>{{ $court->customer->user->username }}</span> Ocena: &#11088; {{ $court->rating }}</p>
                    <p>{{ $court->comment }}</p>
                </div>
            @endforeach
        </div>
    </div>
    @if(auth()->guard('customer')->check())
        <div class="row">
            <div class="col-sm-12">
                <hr>
                <form method="POST" action="{{ route('add-rate') }}">
                    @csrf
                    <input type="hidden" readonly name="complex_id" value="{{ $complex->id }}">
                    <label>Sa koliko zvezdica biste ocenili kompleks?</label><br>

                    <span class="star-rating">
                  <input type="radio" name="rating" value="1"><i>1</i>
                  <input type="radio" name="rating" value="2"><i>2</i>
                  <input type="radio" name="rating" value="3"><i>3</i>
                  <input type="radio" name="rating" value="4"><i>4</i>
                  <input type="radio" name="rating" value="5"><i>5</i>
                </span>

                    <div class="clear"></div>
                    <hr class="survey-hr">
                    <label for="comment">Dodatni komentar:</label><br/><br/>
                    <textarea cols="75" id="comment" name="comment" rows="5" style="width: 100%;"></textarea><br>
                    <br>
                    <div class="clear"></div>
                    <button
                        style="width: 150px; background:rgba(78, 148, 119, 1);color:#fff;padding:12px;border:0; margin-bottom: 10px;"
                        type="submit">Oceni
                    </button>
                </form>
            </div>
        </div>
    @endif
@endsection
