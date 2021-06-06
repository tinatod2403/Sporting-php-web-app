<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="_token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/register-style.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <title>Registracija</title>
</head>
<body style="background-image: url({{asset('assets/front/images/pozadina-registracija.jpg')}});">
<form id="regForm" action="{{ route('register') }}" method="POST">
    @csrf
    <h1>Registracija</h1>
    <div class="tab">Ime i prezime
        <p><input placeholder="Unesite ime" name="first_name" type="text"></p>
        <p><input placeholder="Unesite prezime" name="last_name" type="text"></p>
    </div>

    <div class="tab">Kontakt podaci
        <p><input placeholder="Unesite email" name="email" type="email"></p>
        <p><input placeholder="Unesite broj telefona" name="contact" type="text"></p>
    </div>

    <div class="tab">Datum rodjenja:
        <p><input placeholder="dan" name="day" type="number" min="1" max="31"></p>
        <p><input placeholder="mesec" name="month" type="number" min="1" max="12"></p>
        <p><input placeholder="godina" name="year" type="number" min="1900" max="2100"></p>
    </div>

    <div class="tab">Podaci za logovanje
        <p><input placeholder="Unesite korisnicko ime" name="username" type="text"></p>
        <p><input placeholder="Unesite lozinku" name="password" type="password"></p>
    </div>

    <div style="overflow:auto;">
        <div style="float:right;">
            <button type="button" id="prevBtn" onclick="nextPrev(-1)">Nazad</button>
            <button type="button" id="nextBtn" onclick="nextPrev(1)">Dalje</button>
        </div>
    </div>

    <div id="snackbar">Vasa registracija je stavljena na cekanje!</div>

    @if ($errors->any())
        <div id="snackbar" style="background-color: red;">Podaci nisu dobri, proverite jos jednom!</div>
    @endif

    <div style="text-align:center;margin-top:40px;">
        <span class="step"></span>
        <span class="step"></span>
        <span class="step"></span>
        <span class="step"></span>
    </div>

</form>
<script src="{{ asset('assets/front/js/register-script.js') }}"></script>
</body>
</html>
