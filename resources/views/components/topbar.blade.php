<div id="topbar" class="d-flex align-items-center fixed-top">
    <div class="container d-flex align-items-center justify-content-center justify-content-md-between">
        <div class="align-items-center d-none d-md-flex">

            <div class="title">
                <a href="{{ env('APP_URL') }}"> {{ $data['kontak']->nama}}</a>
            </div>
        </div>
        <div class="d-flex align-items-center">
            {{-- <div class="info">
                <i class="bi bi-envelope"></i>{{ $data['kontak']->email[0]['email']}}
            </div>
            <div class="info">
                <i class="bi bi-telephone"></i>{{ $data['kontak']->phone[0]['phone']}}
            </div> --}}
            <div class="social-icon">
                <a href="{{ $data['kontak']->facebook}}" target="blank"><i class="bi bi-facebook social-icon"></i></a>
                <a href="{{ $data['kontak']->twitter}}" target="blank"><i class="bi bi-twitter social-icon"></i></a>
                <a href="{{ $data['kontak']->linkedin}}" target="blank"><i class="bi bi-linkedin social-icon"></i></a>
                <a href="{{ $data['kontak']->instagram}}" target="blank"><i class="bi bi-instagram social-icon"></i></a>
            </div>

        </div>
    </div>
</div>

<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">
        <nav id="navbar" class="navbar order-last order-lg-0">
            <ul>
                <li><a class="nav-link scrollto " href="{{ url('/') }}">{{ $data['menu']['home']}}</a></li>
                <li class="dropdown"><a class="nav-link" href=""><span>{{ $data['menu']['profile']}}</span></a>
                    <ul>
                        <li><a class="nav-link" href="{{ route('perkenalan') }}">{{ $data['menu']['perkenalan']}}</a>
                        </li>
                        <li><a class="nav-link scrollto" href="{{ route('punggawa') }}">{{
                                $data['menu']['punggawa']}}</a></li>
                        <li><a class="nav-link scrollto" href="{{ route('legalitas') }}">{{
                                $data['menu']['legalitas']}}</a></li>
                    </ul>
                </li>
                <li class="dropdown"><a class="nav-link" href="{{ url('/#services') }}"><span>{{
                            $data['menu']['service']}}</span></a>
                    <ul>
                        <li><a class="nav-link" href="{{ route('testi') }}">{{ $data['menu']['testi']}}</a>
                        </li>
                    </ul>
                </li>
                <li><a class="nav-link scrollto" href="{{ url('/#services') }}">{{ $data['menu']['service']}}</a></li>
                {{-- <li><a class="nav-link scrollto" href="{{ url('/#project') }}">{{ $data['menu']['project']}}</a>
                </li> --}}
                <li><a class="nav-link scrollto" href="{{ url('/direksi') }}">{{ $data['menu']['direksi']}}</a></li>
                <li><a class="nav-link" href="{{ route('kantor') }}">{{ $data['menu']['kantor']}}</a></li>
                <li class="dropdown"><a class="nav-link" href=""><span>{{ $data['menu']['galery']}}</span></a>
                    <ul>
                        <li><a class="nav-link" href="{{ route('buletin') }}">{{ $data['menu']['buletin']}}</a></li>
                        <li><a class="nav-link" href="{{ route('penghargaan') }}">{{ $data['menu']['penghargaan']}}</a>
                        </li>
                    </ul>
                </li>
                <li><a class="nav-link scrollto" href="{{ url('/#contact') }}">{{ $data['menu']['contact']}}</a></li>
            </ul>

            <img class="nav-logo" src="{{ asset('icon/logo.jpeg') }}"></img>
        </nav><!-- .navbar -->

    </div>
</header>