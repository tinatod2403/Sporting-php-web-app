<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="_token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/korisnik.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/moj-profil.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/slide-show.css') }}">
    <script src="{{ asset('assets/front/js/skriptcroll.js') }}"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.1/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    @yield('head')
    @yield('title')
</head>
<body>
<div class="container-fluid">
    @include('web.layout.nav')
    @yield('content')
    @include('web.layout.footer')
    <div id="id01" class="modal1">

        <form class="modal-content1 animate" action="{{ route('login') }}" method="POST">
            @csrf
            <div class="imgcontainer">
                <span onclick="document.getElementById('id01').style.display='none'" class="close1" title="Close Modal">&times;</span>
                <img src="{{ asset('assets/front/images/avatar.jpg') }}" style="width: 100px;" alt="Avatar"
                     class="avatar">
            </div>

            <div class="container1">
                <label for="username"><b>Korisnicko ime</b></label>
                <input type="text" placeholder="Unesite korisnicko ime" id="username" name="username" required>

                <label for="password"><b>Lozinka</b></label>
                <input type="password" placeholder="Unesite lozinku" id="password" name="password" required>
                <button id="login" type="submit">Prijavi se</button>
                <span>Nemate nalog? <a href="{{ route('register-page') }}">Napravi nalog.</a></span>
            </div>

            <div class="container1" style="background-color:#f1f1f1">
                <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">
                    Otkazi
                </button>
                <span class="psw">Zaboravili ste <a href="#">lozinku?</a></span>
            </div>
        </form>
        <script src="{{ asset('assets/front/js/login.js') }}"></script>
    </div>
</div>
</body>
</html>
