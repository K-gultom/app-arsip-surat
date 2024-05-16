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

    <style>
        body {
            position: relative;
        }
        a:hover {
            background-color: #0f6d06;
        }
        .navbar {
            background-color: #0f6d06;
        }
        .navbar-brand {
            margin-left: 10px;
            font-size: 20px;
            font-weight: 600;
        }
        .clr {
            /* background-color: #0262DD; */
            background-color: #0B8500;
            box-shadow: 10px 10px 20px 5px rgb(194, 194, 194);
            
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
            background-color: #0f6d06;
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
    </style>
</head>

<body>
<div class="d-flex">
    <div class="clr max-height-vh-100 min-vh-100 col-2">
        <nav class="nav flex-column">
            <div class="container">
                <a class="head navbar-brand" href="{{ url('/') }}">
                    <div class="row">
                        <div class="col-1 m-6">
                            <img src="{{ url('/assets/images/logo.jpg') }}" height="60">
                            PEMPROV OKI 
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <h3>SuperAdmin</h3>
                            </div>
                            <div class="row">
                                <p>Kepala Desa</p>
                            </div>
                        </div>
                    </div>
                </a>
                {{-- <h3 class="head m-3">dvsdvsdv</h3> --}}
            </div>
        
            <a href="{{ url('/beranda') }}" class="side nav-item nav-link active text-light"><i class="bi bi-house-fill"></i> Beranda</a>
            <div class="nav-item dropdown">
                <a class="side nav-link active text-light dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-people-fill"></i> Data Petugas
                </a>
                <div class="dropdown-menu ml-4">
                    <a href="{{ url('/admin') }}" class="dropdown-item dropHover">Data Admin</a>
                    <a href="{{ url('/rt') }}" class="dropdown-item dropHover">Data RT</a>
                </div>
            </div>
            <a href="{{ url('/umkm') }}" class="side nav-item nav-link active text-light"><i class="bi bi-database"></i> Data UMKM</a>
        </nav>
    </div>

    <div class="col">
        <nav class="navbar navbar-dark navbar-expand-lg border-left-1">
            <div class="container-fluid">
                <div class="d-flex align-items-center">
                    <button id="toggleMenuBtn" class="btn btn-light me-2"><i class="fas fa-bars"></i></button>
                    <a class="navbar-brand" href="#">
                        {{-- Hai {{Auth()->user()->name}} --}}
                    </a>  
                </div>
                <a href="{{url('/logout')}}" class="text-light" style="text-decoration: none; margin-right: 30px;">
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
