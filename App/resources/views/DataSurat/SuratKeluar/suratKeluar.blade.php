@extends('mainLayout.main')

@section('title')
    Surat Keluar
@endsection

@section('content')
    <div class="container-fluid ">
        <h4 class="mb-3">Surat Keluar</h4>
        <nav aria-label="breadcrumb" class="mb-1">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('surat-keluar')}}" class="text-decoration-none">Surat Keluar</a></li>
            <li class="breadcrumb-item active" aria-current="page">Surat Desa</li>
            </ol>
        </nav>

        <div class="card">
            <div class="card-header"> 
                <div class="d-flex">
                    <div class="w-100 pt-1"> 
                        <strong>Surat</strong> Desa <i class="bi bi-envelope"></i>
                    </div>
                    <div class="w-100 pt-1 text-end"> 
                        <a href="{{ url('/data/surat-keluar') }}" class="btn btn-primary btn-sm" title="Refresh"><i class="bi bi-arrow-clockwise"></i></a>
                        <a href="{{ url('/surat-keluar') }}" class="btn btn-success btn-sm">Kembali <i class="bi bi-arrow-return-left"></i></a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="row pb-4">
                    @if (Auth::user()->level == "User")
                        <div class="col">
                            <a href="{{url('/surat-keluar/add')}}" class="btn btn-primary btn-sm"> 
                                Surat Desa Baru <i class="bi bi-envelope-plus"></i> 
                            </a>
                        </div>
                        <div class="col">
                            <form action="">
                                {{-- <label for="search" class="form-label"><strong>Cari Data</strong> UMKM</label><br> --}}
                                <div class="input-group">
                                    <input type="text" class="form-control" name="search" placeholder="Cari No Surat/Pengirim/Penerima/Perihal Surat">
                                    <button class="btn btn-primary btn-sm" type="submit">
                                        <i class="bi bi-search"></i> Search
                                    </button>
                                </div>
                            </form>
                        </div>
                    @endif
                    @if (Auth::user()->level == "Super_Admin")
                        <div class="col-6 offset-3">
                            <form action="">
                                {{-- <label for="search" class="form-label"><strong>Cari Data</strong> UMKM</label><br> --}}
                                <div class="input-group">
                                    <input type="text" class="form-control" name="search" placeholder="Cari No Surat/Pengirim/Penerima/Perihal Surat">
                                    <button class="btn btn-primary btn-sm" type="submit">
                                        <i class="bi bi-search"></i> Search
                                    </button>
                                </div>
                            </form>
                        </div>
                    @endif
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
                            <th>Pengirim</th>
                            <th>Penerima</th>
                            <th class="text-center">File Surat</th>
                            @if (Auth::user()->level == "User")
                                <th class="text-center">Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($getSurat as $item)
                                <tr>
                                    <td>
                                        {{ (($getSurat->currentPage() - 1) * $getSurat->perPage()) + $loop->iteration }} 
                                    </td>
                                    <td>{{$item->nomor_surat}} </td>
                                    <td>{{$item->tgl_surat}} </td>
                                    <td>{{$item->perihal}} </td>
                                    <td>{{$item->getPengirim->name}} </td>
                                    <td>{{$item->getPenerima->nama_bagian}} </td>

                                    <td class="text-center">
                                        <a class="btn btn-outline-info btn-sm" href="{{ asset('/assets/SuratKeluar/' . $item->file_surat) }}" target="_blank">File PDF Surat</a>
                                    </td>
                                    
                                    @if (Auth::user()->level == "User")
                                        <td class="text-center">
                                            <a href="{{ url('/surat-keluar/data') }}/{{ $item->id }}" class="btn btn-success btn-sm" title="Lihat Data">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ url('/surat-keluar/edit') }}/{{ $item->id }}" class="btn btn-warning btn-sm" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <a href="{{ url('/surat-keluar/destroy') }}/{{ $item->id }}" class="btn btn-danger btn-sm" title="Hapus" 
                                                onclick="return confirm('Hapus Data ???');">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </td>
                                    @endif
                                </tr>   
                            @endforeach
                    </tbody>
                </table>
                {{$getSurat->links()}}
            </div>
        </div> 
    </div>
@endsection