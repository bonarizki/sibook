<!doctype html>
<html lang="en">

<head>

    <title>SIBOOK | @yield('title')</title>

    @include('master.user.include.header')

    @yield('css')

</head>

<body>
    <div class="container" >
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}">WOOTISH</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" id="home" aria-current="page" href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('about-us') }}">About Us</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav d-flex">
                        @auth
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Hi, {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="{{ url('status') }}">Status</a></li>
                                    <li><a class="dropdown-item" href="{{ url('logout') }}">Logout</a></li>
                                    {{-- <li><a class="dropdown-item" href="#">Reset Password</a></li> --}}
                                </ul>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="{{ url('login') }}">LOGIN</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="{{ url('register') }}">REGISTER</a>
                            </li>
                        
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <main>

        @yield('content')


    </main>

    <footer class="text-muted py-5 mt-auto" >
        <div class="container">
            <p class="float-end mb-1">
                <a href="#">Back to top</a>
            </p>
            <p class="mb-1"><b>Alamat :<br>Kompleg Bulog, Jl. Raya Pos Pengumben Selatan, RT.5/RW.6,</b></p>
            <p class="mb-1"><b>South Sukabumi, Kebon Jeruk, Suka bumi, Jakarta 11560<br>Phone Admin :<br>082145104751</b><br></p>
            <p class="mb-1"><b>Email:<br>wotishmanagement@gmail.com</b><br></p>
        </div>
    </footer>

    @include('master.user.include.footer')
    
    @yield('script')
</body>

</html>