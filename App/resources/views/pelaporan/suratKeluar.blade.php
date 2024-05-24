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
                        <a href="{{ url('/pelaporan/surat-keluar') }}" class="btn btn-primary">Refresh Data <i class="bi bi-arrow-clockwise"></i></a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-5 offset-3">
                        <form action="" class="form">
                            @csrf

                            <div class="form-group mb-3">
                                <label for="nama_bagian">Dari Tanggal</label>
                                <input type="date" id="nama_bagian" value="{{old('nama_bagian')}}" class="form-control @error('nama_bagian') is-invalid @enderror" name="nama_bagian" placeholder="Nama Bagian...">
                                @error('nama_bagian')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="nama_bagian">Sampai Tanggal</label>
                                <input type="date" id="nama_bagian" value="{{old('nama_bagian')}}" class="form-control @error('nama_bagian') is-invalid @enderror" name="nama_bagian" placeholder="Nama Bagian...">
                                @error('nama_bagian')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Cari <i class="bi bi-search"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> 
    </div>
@endsection