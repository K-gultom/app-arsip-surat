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
            <div class="col-4">
                <div class="card">
                    <div class="card-header"> 
                        <div class="d-flex">
                            <div class="w-100 pt-1"> 
                                <strong>Form</strong> Edit Data <i class="bi bi-person"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            @csrf
                                <div class="form-group mb-3">
                                    <label for="nama_bagian" class="mb-1">Bagian</label>
                                    <input type="text" id="nama_bagian" value="{{old('nama_bagian', $getedit->nama_bagian)}}" class="form-control @error('nama_bagian') is-invalid @enderror" name="nama_bagian" placeholder="Nama Bagian...">
                                    @error('nama_bagian')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Update <i class="bi bi-check-lg"></i></button>
                                <a href="{{ url('/bagian') }}" class="btn btn-warning">Cancel <i class="bi bi-x"></i></a>
                            {{-- <a href="{{ url('/bagian') }}" class="btn btn-danger">Cancel <i class="bi bi-x"></i></a> --}}
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
                            <div class="w-100 text-end">
                                <a href="{{ url('/bagian') }}" class="btn btn-primary text-light btn-sm">Refresh Data <i class="bi bi-arrow-clockwise"></i></a>
                            </div>
                        </div>
                    </div>
        
                    <div class="card-body">
                        <div class="container">
                            <div class="row m-1 mb-3">
                                <form action="">
                                    <label for="search" class="form-label"><strong>Cari Nama </strong> Bagian</label> <br> 
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="search" placeholder="Cari Nama Bagian...">
                                        <button class="btn  btn-primary" type="submit">
                                            <i class="bi bi-search"></i> Search
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

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
                                @foreach ($getData as $item)
                                        <tr>
                                            <td>
                                               {{ (($getData->currentPage() - 1) * $getData->perPage()) + $loop->iteration }}
                                            </td>
                                            <td>{{$item->nama_bagian}} </td>
                                            <td class="text-center">
                                                <a href="{{ url('/bagian/edit') }}" class="btn btn-warning btn-sm" title="Edit">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <a href="{{ url('bagian/destroy') }}/{{ $item->id }}" class="btn btn-danger btn-sm" title="Hapus" 
                                                    onclick="return confirm('Hapus Data ???');">
                                                    <i class="bi bi-trash"></i>
                                                </a>
                                            </td>
                                        </tr>   
                                    @endforeach
                            </tbody>
                        </table>
                        {{-- <a href="{{url('/admin')}}" class="btn btn-primary">Refresh Page</a> --}}
                        {{$getData->links()}}
                    </div>
                </div> 
            </div>
        </div>
        
    </div>

    
    
@endsection