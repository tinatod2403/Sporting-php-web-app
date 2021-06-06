<div class="row">
    <div class="col-sm-12 header" id="myHeader">
        <div class="">
            <img class="header-bg" src="{{ asset('assets/front/images/header.jpg') }}">
            <nav class="navbar navbar-expand-sm header-content ">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img src="{{ asset('assets/front/images/logo.png') }}" alt="Logo" style="width:40px;">
                </a>
                <ul class="navbar-nav">
                    <li class="nav-item ">
                        <a class="nav-link" href="{{ (request()->is('/')) ? "#" : route('home') }}"
                           onclick="scrollfunction_nov()">NOVOSTI</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ (request()->is('/')) ? "#" : route('home') }}"
                           onclick="scrollfunction_pro()">PROMOCIJE </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ (request()->is('/')) ? "#" : route('home') }}">PODRŠKA</a>
                    </li>
                    <li class="nav-item o_nama">
                        <a class="nav-link" href="{{ route('about-us') }}">O NAMA</a>
                    </li>
                    @if(!auth()->guard('customer')->check())
                        <li class="nav-item ">
                            <a class="nav-link prijavi_se" href="#"
                               onclick="document.getElementById('id01').style.display='block'">PRIJAVI SE</a>
                        </li>
                    @endif
                </ul>
                @if(auth()->guard('customer')->check())
                    <div id="mySidenav" class="sidenav">
                        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                        <img class="" href="#" src="{{ asset('assets/front/images/ver-avatar.png') }}"
                             style="min-width:70px; height: 70px; padding-left: 50px;">
                        <a href="{{ route('my-profile') }}">Moj profil</a>
                        <a href="{{ route('logout') }}">Odjavi se</a>
                    </div>
                    <div id="main">
                        <span style="font-size:30px;cursor:pointer" onclick="openNav()"><a class="nav-link ver-avatar"
                                                                                           href="#">
                          <img class="" href="#" src="{{ asset('assets/front/images/ver-avatar.png') }}"
                               style="width:70px;">
                      </a></span>
                        <script src="{{ asset('assets/front/js/korisnik.js') }}"></script>
                    </div>
                @endif
            </nav>
        </div>
    </div>
</div>
