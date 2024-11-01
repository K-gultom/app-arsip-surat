<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <!-- Bootstrap Assets CSS -->

    <link rel="stylesheet" href="{{ url('assets/bootstrap5/css/bootstrap.min.css') }}">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    {{-- Bootstrap ICON --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <script src="https://kit.fontawesome.com/f181524b5b.js" crossorigin="anonymous"></script>

    {{-- Calender --}}
    <!-- Tambahkan ini di dalam <head> layout utama atau view -->
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css' rel='stylesheet' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js'></script>
    
    <style>
        body {
            position: relative;
        }
        a:hover {
            background-color: #0452b9;
        }
        .navbar {
            background-color: #0452b9;
        }
        .navbar-brand {
            margin-left: 10px;
            font-size: 20px;
            font-weight: 600;
        }
        .clr {
            /* background-color: #0262DD; */
            background-color: #0262DD;
            /* background-color: #004195; */
            box-shadow: 10px 10px 20px 5px rgb(194, 194, 194);
            width: 250px;
        }
        .head {
            color: #ffffff;
        }
        .head:hover {
            color: #ffffff;
        }
        .content-wrap {
            min-height: 100%;
            padding-bottom: 50px;
        }
        .dropHover:hover {
            color: #fff;
            background-color: #0452b9;
        }
        .dropdown-menu {
            width: 80%;
            /* margin-left: 10%; */
        }
        footer {
            background-color: #4e4d4d;
            color: #fff;
            height: 50px;
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 10px;
            text-align: center;
        }
        .foot{
            margin-bottom: 150px;
        }
        .level{
            font-size: 20px;
        }
        .jabatan{
            font-size: 16px;
        }
        .logout-btn{
            border-radius: 50px;
            text-decoration: none; 
            margin-right: 30px;
            background-color: #0c3c7a;
        }
        .logout-btn:hover{
            background-color: #021733;

        }
    </style>
</head>

<body>
<div class="d-flex">
    <div class="clr max-height-vh-100 min-vh-100"> 
        {{-- //tmbah col kalau mau dinamis dari laravel --}}
        <nav class="nav flex-column">
            <div class="container">
                <a class="head navbar-brand" href="{{ url('/beranda') }}">
                    <div class="row text-center">
                        <div class="col-12">
                            <img class="rounded-3" src="{{ url('/assets/images/logo.jpg') }}" height="80">
                        </div>
                        <div class="col">
                            <div class="row mt-3">
                                <div class="col text-center mb-3">
                                    <h4>Desa Karya Multi</h4>
                                    @if (Auth::user()->level == 'Super_Admin')
                                         <div class="level">Super Admin</div>
                                    @elseif (Auth::user()->level == 'Admin')
                                        <div class="level">Admin</div>
                                    @elseif (Auth::user()->level == 'User')
                                        <div class="level">User</div>
                                    @endif
                                    {{-- <div class="jabatan mb-3">{{ Auth::user()->Jabatan }}</div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                {{-- <h3 class="head m-3">dvsdvsdv</h3> --}}
            </div>
        
            <a href="{{ url('/beranda') }}" class="side nav-item nav-link active text-light"><i class="bi bi-house-fill"></i> Beranda</a>

            @if (Auth::user()->level == 'Super_Admin' || Auth::user()->level == 'Admin')
                {{-- MASter Data --}}
                <div class="nav-item dropdown">
                    <a class="side nav-link active text-light dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-database-fill"></i> Data Master
                    </a>
                    <div class="dropdown-menu ml-4">
                        @if (Auth::user()->level == 'Super_Admin')
                            <a href="{{ url('/user') }}" class="dropdown-item dropHover">Data User</a>
                        @endif
                        <a href="{{ url('/bagian') }}" class="dropdown-item dropHover">Data Bagian</a>
                    </div>
                </div>
            @endif
            
            {{-- Data Surat --}}
            <div class="nav-item dropdown">
                <a class="side nav-link active text-light dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-envelope-fill"></i> Data Surat
                </a>
                <div class="dropdown-menu ml-4">
                    <a href="{{ url('/data/surat-masuk') }}" class="dropdown-item dropHover">Surat Masuk</a>
                    <a href="{{ url('/surat-keluar') }}" class="dropdown-item dropHover">Surat Keluar</a>
                </div>
            </div>
            {{-- Pelaporan --}}
            <div class="nav-item dropdown">
                <a class="side nav-link active text-light dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-exclamation-circle-fill"></i> Pelaporan
                </a>
                <div class="dropdown-menu ml-4">
                    <a href="{{ url('/pelaporan/surat-masuk') }}" class="dropdown-item dropHover">Surat Masuk</a>
                    <a href="{{ url('/pelaporan/surat-keluar') }}" class="dropdown-item dropHover">Surat Keluar</a>
                </div>
            </div>
        </nav>
    </div>

    <div class="col">
        <nav class="navbar navbar-dark navbar-expand-lg border-left-1">
            <div class="container-fluid">
                <div class="d-flex align-items-center">
                    <button id="toggleMenuBtn" class="btn btn-light me-2"><i class="fas fa-bars"></i></button>
                    <a class="navbar-brand" href="#">
                        Hai {{Auth()->user()->name}}  <strong>-</strong> {{ Auth::user()->Jabatan }}
                    </a>  
                </div>
                <a href="{{url('/logout')}}" class="text-light btn btn-sm logout-btn">
                    Logout  <i class="fa-solid fa-power-off"></i>
                    {{-- <i class="bi bi-box-arrow-right text-light ms-auto"></i> --}}
                </a>
            </div>
            
        </nav>

        <div class="mx-2 p-1 foot">
            @yield('content')
        </div> 

        <footer class="text-center p-3">
            &copy; 2024 - Surat Masuk/Keluar Apps All rights reserved.
        </footer>
    </div>
</div>

<!-- Bootstrap Bundle with Popper -->
<script src="{{ url('assets/bootstrap5/js/bootstrap.bundle.min.js') }}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleMenuBtn = document.getElementById('toggleMenuBtn');
        const sidebar = document.querySelector('.clr');

        toggleMenuBtn.addEventListener('click', function() {
            sidebar.classList.toggle('d-none');
        });
    });
    
</script>
</body>
</html>
