@extends('mainLayout.main')

@section('title')
    Surat Keluar
@endsection

@section('content')
    <div class="container-fluid">
        <h4 class="mb-3">Surat Keluar</h4>
        <nav aria-label="breadcrumb" class="mb-1">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Surat Keluar</li>
            </ol>
        </nav>

        {{-- <div class="row mb-4">
            <div class="col text-center">
                <div class="card align-items-center">
                    <img src="{{ url('assets/images/surat.png') }}" class="card-img-top" alt="..." style="width: 100px; height: 100px;">
                    <div class="card-body">
                        <h5 class="card-title">Surat Desa</h5>
                        <a href="{{ url('/data/surat-keluar') }}" class="btn btn-success btn-sm">Lihat Data</a>
                    </div>
                </div>
            </div> 
        </div> --}}

        <div class="row">
            <div class="col text-center">
                <div class="card align-items-center">
                    <img src="{{ url('assets/images/surat.png') }}" class="card-img-top" alt="..." style="width: 100px; height: 100px;">
                    <div class="card-body">
                        <h5 class="card-title">Surat Keterangan Usaha</h5>
                        <a href="{{ url('/surat-usaha') }}" class="btn btn-success btn-sm">Lihat Data</a>
                        {{-- <a href="{{ url('/surat-usaha') }}" class="btn btn-primary btn-sm">Buat Surat</a> --}}
                    </div>
                </div>
            </div>   
            <div class="col text-center">
                <div class="card align-items-center">
                    <img src="{{ url('assets/images/surat.png') }}" class="card-img-top" alt="..." style="width: 100px; height: 100px;">
                    <div class="card-body">
                        <h5 class="card-title">Surat Keterangan Tidak Mampu</h5>
                        <a href="{{ url('/surat-tidak-mampu') }}" class="btn btn-success btn-sm">Lihat Data</a>
                        {{-- <a href="#" class="btn btn-primary btn-sm">Buat Surat</a> --}}
                    </div>
                </div>
            </div>            
            <div class="col text-center">
                <div class="card align-items-center">
                    <img src="{{ url('assets/images/surat.png') }}" class="card-img-top" alt="..." style="width: 100px; height: 100px;">
                    <div class="card-body">
                        <h5 class="card-title">Surat Keterangan Domisili </h5>
                        <a href="{{ url('/surat-domisili') }}" class="btn btn-success btn-sm">Lihat Data</a>
                        {{-- <a href="#" class="btn btn-primary btn-sm">Buat Surat</a> --}}
                    </div>
                </div>
            </div>         
        </div>

    </div>

@endsection