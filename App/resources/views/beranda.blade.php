@extends('mainLayout.main')

@section('title')
    Beranda
@endsection

@section('content')
    <div class="container-fluid">
        <h4 class="mb-3">Beranda</h4>
        <nav aria-label="breadcrumb" class="mb-1">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Beranda</li>
            </ol>
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
                    <div class="col-lg-6 col-md-6 mb-4">
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

                    {{-- Surat Keluar --}}
                    <div class="col-lg-6 col-md-6 mb-4">
                        <div class="card" id="card-info">
                            <div class="card-body">
                                {{-- <h6 class="rounded-3 p-2 text-light" style="background-color: #762A01">Surat Masuk</h6> --}}
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="row">
                                        <div class="col">
                                            <div class="text_card">Surat Keluar</div>
                                            <i class="bi bi-envelope-arrow-up-fill custom-icon-size"></i> 
                                        </div>
                                    </div>
                                    <h4 class="mx-2">{{ $getSuratKeluar }}</h4>
                                </div>
                                <div class="text-end mt-2">
                                    <a href="{{ url('/data/surat-keluar') }}" class="btn btn-outline-light">Lihat Data <i class="bi bi-eye"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if (Auth::user()->level == "Super_Admin")
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

                    {{-- Surat Keluar --}}
                    <div class="col-lg-4 col-md-4 mb-4">
                        <div class="card" id="card-info">
                            <div class="card-body">
                                {{-- <h6 class="rounded-3 p-2 text-light" style="background-color: #762A01">Surat Masuk</h6> --}}
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="row">
                                        <div class="col">
                                            <div class="text_card">Surat Keluar</div>
                                            <i class="bi bi-envelope-arrow-up-fill custom-icon-size"></i> 
                                        </div>
                                    </div>
                                    <h4 class="mx-2">{{ $getSuratKeluar }}</h4>
                                </div>
                                <div class="text-end mt-2">
                                    <a href="{{ url('/data/surat-keluar') }}" class="btn btn-outline-light">Lihat Data <i class="bi bi-eye"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Jumlah User --}}
                    <div class="col-lg-4 col-md-4 mb-4">
                        <div class="card" id="card-info">
                            <div class="card-body">
                                {{-- <h6 class="rounded-3 p-2 text-light" style="background-color: #762A01">Surat Masuk</h6> --}}
                                <div class="d-flex align-items-center justify-content-between">
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
                @endif
            {{-- @endfor --}}
            <!-- Add more cards here -->
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
            text-align: center;
        }
        .card-title {
            font-size: 2.5rem;
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
