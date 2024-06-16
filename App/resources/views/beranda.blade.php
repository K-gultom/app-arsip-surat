@extends('mainLayout.main')

@section('title')
    Beranda
@endsection

@section('content')
    <div class="container-fluid">
        <nav aria-label="breadcrumb" class="mb-1 d-flex justify-content-between align-items-center">
            <div class="left">
                <h4 class="mb-3">Beranda</h4>
                <ol class="breadcrumb mb-3">
                    <li class="breadcrumb-item active" aria-current="page">Beranda</li>
                </ol>
            </div>
            @if (Auth::user()->level == 'Super_Admin')
                <div class="text-end text-center">
                    <h5 class="mt-2">Waktu Saat Ini</h5>
                    <h5 class="text-dark mt-3" id="current-waktu" style="margin-bottom: 30px"></h5>
                </div>
                <script>
                    function updateTime() {
                        const now = new Date();
                        const hours = String(now.getHours()).padStart(2, '0');
                        const minutes = String(now.getMinutes()).padStart(2, '0');
                        const seconds = String(now.getSeconds()).padStart(2, '0');
                        const timeString = `${hours}:${minutes}:${seconds} WIB`;
                        document.getElementById('current-waktu').textContent = timeString;
                    }
                
                    // Update the time every second
                    setInterval(updateTime, 1000);
                
                    // Set the initial time
                    updateTime();
                </script>
            @endif
        </nav>
        
        
        {{-- <div class="row mb-3">
            <div class="col">
                <div class="card p-3 text-center">
                    <div class="card-text text-dark"><h2>Arsip Surat Desa Karya Mukti</h2></div>
                </div>
            </div>
        </div> --}}
        <div class="row">
            {{-- @for ($a = 0; $a < 3; $a++) --}}

                @if (Auth::user()->level == "Admin" || Auth::user()->level == "User")
                    {{-- Surat Masuk --}}
                    <div class="col-lg-4 col-md-4 mb-4">
                        <div class="card" id="card-info">
                            <div class="card-body">
                                {{-- <h6 class="rounded-3 p-2 text-light" style="background-color: #762A01">Surat Masuk</h6> --}}
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="row">
                                        <div class="col">
                                            <div class="text_card">Surat Masuk</div>
                                            <i class="bi bi-envelope-arrow-down-fill custom-icon-size"></i> 
                                        </div>
                                    </div>
                                    <h4 class="mx-2">{{ $getSuratMasuk }}</h4>
                                </div>
                                <div class="text-end mt-2">
                                    <a href="{{ url('/data/surat-masuk') }}" class="btn btn-outline-light">Lihat Data <i class="bi bi-eye"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if (Auth::user()->level == "Admin" || Auth::user()->level == "User")
                        <div class="col-lg-4 col-md-4 mb-4">
                            <div class="card" id="card-info">
                                <div class="card-body">
                                    {{-- <h6 class="rounded-3 p-2 text-light" style="background-color: #762A01">Surat Masuk</h6> --}}
                                    <div class="d-flex text-start center justify-content-between">
                                        <div class="row">
                                            <div class="col">
                                                <div class="text_card">Surat Keterangan Usaha</div>
                                                <i class="bi bi-envelope-arrow-up-fill custom-icon-size"></i> 
                                            </div>
                                        </div>
                                        <h4 class="mx-2">{{ $getSuratKeteranganUsaha }}</h4>
                                    </div>
                                    <div class="text-end mt-2">
                                        <a href="{{ url('/surat-usaha') }}" class="btn btn-outline-light">Lihat Data <i class="bi bi-eye"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="col-lg-4 col-md-4 mb-4">
                        <div class="card" id="card-info">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="row">
                                        <div class="col">
                                            <div class="text_card">Waktu Saat ini</div>
                                            <i class="bi bi-clock-fill custom-icon-size"></i> 
                                        </div>
                                    </div>
                                    <h4 class="mx-2 jam" id="current-time"></h4>
                                </div>
                                <div class="text-end mt-2 mt-5">
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                        function updateTime() {
                            const now = new Date();
                            const hours = String(now.getHours()).padStart(2, '0');
                            const minutes = String(now.getMinutes()).padStart(2, '0');
                            const seconds = String(now.getSeconds()).padStart(2, '0');
                            const timeString = `${hours}:${minutes}:${seconds} WIB`;
                            document.getElementById('current-time').textContent = timeString;
                        }
                    
                        // Update the time every second
                        setInterval(updateTime, 1000);
                    
                        // Set the initial time
                        updateTime();
                    </script>
                @endif

                @if (Auth::user()->level == "Super_Admin")
                    {{-- Surat Masuk --}}
                    <div class="col-lg-4 col-md-4 mb-4">
                        <div class="card" id="card-info">
                            <div class="card-body">
                                {{-- <h6 class="rounded-3 p-2 text-light" style="background-color: #762A01">Surat Masuk</h6> --}}
                                <div class="d-flex text-start justify-content-between">
                                    <div class="row">
                                        <div class="col">
                                            <div class="text_card">Surat Masuk</div>
                                            <i class="bi bi-envelope-arrow-down-fill custom-icon-size"></i> 
                                        </div>
                                    </div>
                                    <h4 class="mx-2">{{ $getSuratMasuk }}</h4>
                                </div>
                                <div class="text-end mt-2">
                                    <a href="{{ url('/data/surat-masuk') }}" class="btn btn-outline-light">Lihat Data <i class="bi bi-eye"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Jumlah User --}}
                    <div class="col-lg-4 col-md-4 mb-4">
                        <div class="card" id="card-info">
                            <div class="card-body">
                                {{-- <h6 class="rounded-3 p-2 text-light" style="background-color: #762A01">Surat Masuk</h6> --}}
                                <div class="d-flex text-start justify-content-between">
                                    <div class="row">
                                        <div class="col">
                                            <div class="text_card">User</div>
                                            <i class="bi bi-people-fill custom-icon-size"></i>
                                        </div>
                                    </div>
                                    <h4 class="mx-2">{{ $getUser }}</h4>
                                </div>
                                <div class="text-end mt-2">
                                    <a href="{{ url('/user') }}" class="btn btn-outline-light">Lihat Data <i class="bi bi-eye"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="col-lg-4 col-md-4 mb-4">
                        <div class="card" id="card-info">
                            <div class="card-title text-center">User Profile</div>
                            <div class="card-body">
                                <table class="teble">
                                    <tr>
                                        <td>Nama</td>
                                        <td>:</td>
                                        <td>
                                            {{ $getUserInfo->name }} - 
                                            @if ($getUserInfo->level == 'Super_Admin')
                                                Super Admin
                                            @elseif ($getUserInfo->level == 'Admin')
                                                Admin
                                            @elseif ($getUserInfo->level == 'User')
                                                User
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Telepon</td>
                                        <td>:</td>
                                        <td>{{ $getUserInfo->telp }}</td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>:</td>
                                        <td>{{ $getUserInfo->email }}</td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td>:</td>
                                        <td>{{ $getUserInfo->alamat }}</td>
                                    </tr>
                                    
                                </table>
                            </div>
                        </div>
                    </div> --}}

                    <div class="col-lg-4 col-md-4 mb-4">
                        <div class="card" id="card-info">
                            <div class="card-body">
                                {{-- <h6 class="rounded-3 p-2 text-light" style="background-color: #762A01">Surat Masuk</h6> --}}
                                <div class="d-flex text-start justify-content-between">
                                    <div class="row">
                                        <div class="col">
                                            <div class="text_card">Surat Keterangan Domisili</div>
                                            <i class="bi bi-envelope-arrow-up-fill custom-icon-size"></i> 
                                        </div>
                                    </div>
                                    <h4 class="mx-2">{{ $getSuratDomisili }}</h4>
                                </div>
                                <div class="text-end mt-2">
                                    <a href="{{ url('/surat-domisili') }}" class="btn btn-outline-light">Lihat Data <i class="bi bi-eye"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            {{-- @endfor --}}
            <!-- Add more cards here -->
        </div>

        <div class="row">
            @if (Auth::user()->level == "Super_Admin")
                <div class="col-lg-4 col-md-4 mb-4">
                    <div class="card" id="card-info">
                        <div class="card-body">
                            {{-- <h6 class="rounded-3 p-2 text-light" style="background-color: #762A01">Surat Masuk</h6> --}}
                            <div class="d-flex text-start center justify-content-between">
                                <div class="row">
                                    <div class="col">
                                        <div class="text_card">Surat Keterangan Usaha</div>
                                        <i class="bi bi-envelope-arrow-up-fill custom-icon-size"></i> 
                                    </div>
                                </div>
                                <h4 class="mx-2">{{ $getSuratKeteranganUsaha }}</h4>
                            </div>
                            <div class="text-end mt-2">
                                <a href="{{ url('/surat-usaha') }}" class="btn btn-outline-light">Lihat Data <i class="bi bi-eye"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                
            @endif


            <div class="col-lg-4 col-md-4 mb-4">
                <div class="card" id="card-info">
                    <div class="card-body">
                        {{-- <h6 class="rounded-3 p-2 text-light" style="background-color: #762A01">Surat Masuk</h6> --}}
                        <div class="d-flex text-start justify-content-between">
                            <div class="row">
                                <div class="col">
                                    <div class="text_card">Surat Keterangan Tidak Mampu</div>
                                    <i class="bi bi-envelope-arrow-up-fill custom-icon-size"></i> 
                                </div>
                            </div>
                            <h4 class="mx-2">{{ $getSuratTidakMampu }}</h4>
                        </div>
                        <div class="text-end mt-2">
                            <a href="{{ url('/surat-tidak-mampu') }}" class="btn btn-outline-light">Lihat Data <i class="bi bi-eye"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            @if (Auth::user()->level == "Admin" || Auth::user()->level == "User")
            <div class="col-lg-4 col-md-4 mb-4">
                <div class="card" id="card-info">
                    <div class="card-body">
                        {{-- <h6 class="rounded-3 p-2 text-light" style="background-color: #762A01">Surat Masuk</h6> --}}
                        <div class="d-flex text-start justify-content-between">
                            <div class="row">
                                <div class="col">
                                    <div class="text_card">Surat Keterangan Domisili</div>
                                    <i class="bi bi-envelope-arrow-up-fill custom-icon-size"></i> 
                                </div>
                            </div>
                            <h4 class="mx-2">{{ $getSuratDomisili }}</h4>
                        </div>
                        <div class="text-end mt-2">
                            <a href="{{ url('/surat-domisili') }}" class="btn btn-outline-light">Lihat Data <i class="bi bi-eye"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            


        {{--             
            @if (Auth::user()->level == "Admin" || Auth::user()->level == "User")
                <div class="col-lg-4 col-md-4 mb-4">
                    <div class="card" id="card-info">
                        <div class="card-title text-center">User Profile</div>
                        <div class="card-body">
                            <table class="teble">
                                <tr>
                                    <td>Nama</td>
                                    <td>:</td>
                                    <td>
                                        {{ $getUserInfo->name }} - 
                                        @if ($getUserInfo->level == 'Super_Admin')
                                            Super Admin
                                        @elseif ($getUserInfo->level == 'Admin')
                                            Admin
                                        @elseif ($getUserInfo->level == 'User')
                                            User
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Telepon</td>
                                    <td>:</td>
                                    <td>{{ $getUserInfo->telp }}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>:</td>
                                    <td>{{ $getUserInfo->email }}</td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>:</td>
                                    <td>{{ $getUserInfo->alamat }}</td>
                                </tr>
                                
                            </table>
                        </div>
                    </div>
                </div>
            @endif 
        --}}
            

        </div>



        <div class="row calendar mt-4">
            <div class="card card-calendar">
                <div class="card-body">
                    <div id="calendar"></div>
                </div>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var calendarEl = document.getElementById('calendar');
                    var calendar = new FullCalendar.Calendar(calendarEl, {
                        initialView: 'dayGridMonth'
                    });
                    calendar.render();
                });
            </script>
        </div>
    </div>


    <style>
         #card-info{
            background-color: #0452b9;
            color: #ffff;
        }
        .jam{
            font-size: 35px;
        }
        .card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            background-color: #F0EBEB;
        }
        .card:hover {
            transform: translateY(-10px);
        }
        .card-body {
            padding: 20px;
            text-start center;
        }
        .card-title {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .card-text {
            font-size: 1.5rem;
            color: #6c757d;
        }
        .btn-more-info {
            background-color: #007bff;
            color: #fff;
            border-radius: 5px;
            padding: 8px 16px;
            transition: background-color 0.3s ease;
        }
        .btn-more-info:hover {
            background-color: #0056b3;
        }
        #calendar {
            /* max-width: 900px; */
            max-height: 450px;
            margin: 0 auto;
            padding: auto;
        }
        .custom-icon-size {
            font-size: 40px; /* Adjust the size as needed */
        }
        .text_card{
            font-size: 20px;
        }
    </style>
@endsection
