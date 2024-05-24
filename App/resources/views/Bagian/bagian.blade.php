@extends('mainLayout.main')

@section('title')
    Bagian
@endsection

@section('content')
    <div class="container-fluid ">
        <h4 class="mb-3">Data Bagian</h4>
        <nav aria-label="breadcrumb" class="mb-1">
            <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Data Bagian</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col">
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
                                    <label for="nama_bagian">Bagian</label>
                                    <input type="text" id="nama_bagian" value="{{old('nama_bagian')}}" class="form-control @error('nama_bagian') is-invalid @enderror" name="nama_bagian" placeholder="Nama Bagian...">
                                    @error('nama_bagian')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            <button type="submit" class="btn btn-primary">Save <i class="bi bi-check-lg"></i></button>
                            <a href="{{ url('/bagian') }}" class="btn btn-danger">Cancel <i class="bi bi-x"></i></a>
                       </form>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card">
                    <div class="card-header"> 
                        <div class="d-flex">
                            <div class="w-100 pt-1"> 
                                <strong>Data</strong> Bagian <i class="bi bi-person"></i>
                            </div>
                        </div>
                    </div>
        
                    <div class="card-body">
                        {{-- <div class="row pb-4">
                            <div class="col">
                                <a href="{{url('/user/add')}}" class="btn btn-primary btn-sm"> 
                                    Tambah Bagian <i class="bi bi-plus-circle"></i> 
                                </a>
                            </div>
                            <div class="col">
                                <form action="">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="search" placeholder="Cari Data User (Nama)...">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="bi bi-search"></i> Search
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>  --}}
                        @if(session('message'))
                            <div id="flash-message" class="alert alert-success">
                                {{ session('message') }}
                            </div>
                            <script>
                                setTimeout(function() {
                                    document.getElementById('flash-message').style.display = 'none';
                                }, {{ session('timeout', 5000) }});
                            </script>
                        @endif
        
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Bagian</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @foreach ($data as $item) --}}
                                        <tr>
                                            <td>
                                                {{-- {{ (($data->currentPage() - 1) * $data->perPage()) + $loop->iteration }}  --}} 1
                                            </td>
                                            {{-- <td>{{$item->name}} </td>
                                            <td>{{$item->email}} </td>
                                            <td>{{$item->telp}} </td> --}}
                                            <td>Sekretaris</td>
                                            <td class="text-center">
                                                <a href="" class="btn btn-warning btn-sm" title="Edit">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <a href="" class="btn btn-danger btn-sm" title="Hapus" 
                                                    onclick="return confirm('Hapus Data ???');">
                                                    <i class="bi bi-trash"></i>
                                                </a>
                                            </td>
                                        </tr>   
                                    {{-- @endforeach --}}
                            </tbody>
                        </table>
                        {{-- <a href="{{url('/admin')}}" class="btn btn-primary">Refresh Page</a> --}}
                        {{-- {{$data->links()}} --}}
                    </div>
                </div> 
            </div>
        </div>
        
    </div>

    
    
@endsection