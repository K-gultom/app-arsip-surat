@extends('mainLayout.main')

@section('title')
    Bagian
@endsection

@section('content')
    <div class="container-fluid ">
        <h4 class="mb-3">Data Bagian</h4>
        <nav aria-label="breadcrumb" class="mb-1">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/bagian')}}" class="text-decoration-none">Data Bagian</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Data</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-6 offset-3">
                <div class="card">
                    <div class="card-header"> 
                        <div class="d-flex">
                            <div class="w-100 pt-1"> 
                                <strong>Form</strong> Tambah Data <i class="bi bi-person"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('/bagian/add') }}" method="post">
                            @csrf
                                <div class="form-group mb-3">
                                    <label for="nama_bagian" class="mb-1">Bagian</label>
                                    <input type="text" id="nama_bagian" value="{{old('nama_bagian')}}" class="form-control @error('nama_bagian') is-invalid @enderror" name="nama_bagian" placeholder="Nama Bagian...">
                                    @error('nama_bagian')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            <button type="submit" class="btn btn-primary btn-sm">Save <i class="bi bi-check-lg"></i></button>
                            <button type="reset" class="btn btn-warning btn-sm">Reset <i class="bi bi-x"></i></button>
                            <a href="{{ url('/bagian') }}" class="btn btn-success btn-sm mx-3">Cancel <i class="bi bi-arrow-return-left"></i></a>
                       </form>
                    </div>
                </div>
            </div>

        </div>
        
    </div>

    
    
@endsection