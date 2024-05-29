@extends('mainLayout.main')

@section('title')
    Pelaporan Surat Keluar
@endsection

@section('content')
    <div class="container-fluid ">
        <h4 class="mb-3">Pelaporan Surat Keluar</h4>
        <nav aria-label="breadcrumb" class="mb-1">
            <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page"> Pelaporan Surat Keluar</li>
            </ol>
        </nav>

        <div class="card">
            <div class="card-header"> 
                <div class="d-flex">
                    <div class="w-100 pt-1"> 
                        <strong>Surat</strong> Keluar <i class="bi bi-envelope"></i>
                    </div>
                    <div class="w-100 pt-1 text-end"> 
                        <a href="{{ url('/pelaporan/surat-keluar') }}" class="btn btn-primary btn-sm">Refresh Data <i class="bi bi-arrow-clockwise"></i></a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                @if(session('message'))
                    <div id="flash-message" class="alert alert-warning">
                        {{ session('message') }}
                    </div>
                    <script>
                        setTimeout(function() {
                            document.getElementById('flash-message').style.display = 'none';
                        }, {{ session('timeout', 5000) }});
                    </script>
                @endif
                <div class="row">
                    <div class="col-5 offset-3">
                        <form action="" class="form" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="awal">Dari Tanggal</label>
                                <input type="date" id="awal" value="{{old('awal')}}" class="form-control @error('awal') is-invalid @enderror" name="awal">
                                @error('awal')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="akhir">Sampai Tanggal</label>
                                <input type="date" id="akhir" value="{{old('akhir')}}" class="form-control @error('akhir') is-invalid @enderror" name="akhir">
                                @error('akhir')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Cari <i class="bi bi-search"></i></button>
                                {{-- <a href="{{ url('/cetak/surat-masuk') }}" class="btn btn-warning">Cari WARNING!!!!!</a> --}}
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> 
    </div>
@endsection