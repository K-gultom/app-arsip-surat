@extends('mainLayout.main')

@section('title')
    Dashboard
@endsection

@section('content')
    <div class="container-fluid">
        <h4 class="mb-3">Beranda</h4>
        <nav aria-label="breadcrumb" class="mb-1">
            <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Beranda</li>
            </ol>
        </nav>
        
        <div class="row mb-3 ">
            <div class="col">
                <div class="card p-3 text-center">
                    <div class="card-text text-dark"><h2>Arsip Surat Desa Karya Mukti</h2></div>
                </div>
            </div>
        </div>
        <div class="row">
            @for ($a = 0; $a < 2; $a++)
                <div class="col-lg-6 col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">150</h3>
                            <p class="card-text">New Orders</p>
                            <a href="#" class="btn btn-success">More info <i class="fas fa-arrow-circle-right ms-2"></i></a>
                        </div>
                    </div>
                </div>
            @endfor
            <!-- Add more cards here -->
        </div>
        <div class="row calendar">
            
        </div>

    </div>

    <style>
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
    </style>
@endsection