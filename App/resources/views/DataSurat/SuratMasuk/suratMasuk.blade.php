@extends('mainLayout.main')

@section('title')
    Surat Masuk
@endsection

@section('content')
    <div class="container-fluid ">
        <h4 class="mb-3">Surat Masuk</h4>
        <nav aria-label="breadcrumb" class="mb-1">
            <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Surat Masuk</li>
            </ol>
        </nav>

        <div class="card">
            <div class="card-header"> 
                <div class="d-flex">
                    <div class="w-100 pt-1"> 
                        <strong>Surat</strong> Masuk <i class="bi bi-envelope"></i>
                    </div>
                    <div class="w-100 pt-1 text-end"> 
                        <a href="{{ url('/data/surat-masuk') }}" class="btn btn-primary btn-sm">Refresh Data <i class="bi bi-arrow-clockwise"></i></a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="row pb-4">
                    <div class="col">
                        <a href="{{url('/surat-masuk/add')}}" class="btn btn-primary btn-sm"> 
                            Surat Masuk Baru <i class="bi bi-envelope-plus"></i> 
                        </a>
                    </div>
                    <div class="col">
                        <form action="">
                            {{-- <label for="search" class="form-label"><strong>Cari Data</strong> UMKM</label><br> --}}
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Cari Data User (Nama)...">
                                <button class="btn btn-primary btn-sm" type="submit">
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
                            <th>No Surat</th>
                            <th>Tgl Surat</th>
                            <th>Perihal</th>
                            <th class="text-center">File Surat</th>
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
                                    <td>KDOKI/2405202401</td>
                                    <td>24-05-2024</td>
                                    <td>Rapat Semua Ketua RT</td>
                                    <td class="text-center">
                                        <img src="" alt="KDOKI/2405202401">
                                    </td>
                                    <td class="text-center">
                                        <a href="" class="btn btn-success btn-sm" title="Lihat Data">
                                            <i class="bi bi-eye"></i>
                                        </a>
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
@endsection