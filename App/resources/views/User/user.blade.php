@extends('mainLayout.main')

@section('title')
    User
@endsection

@section('content')
    <div class="container-fluid ">
        <h4 class="mb-3">Data User</h4>
        <nav aria-label="breadcrumb" class="mb-1">
            <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Data User</li>
            </ol>
        </nav>

        <div class="card">
            <div class="card-header"> 
                <div class="d-flex">
                    <div class="w-100 pt-1"> 
                        <strong>Data</strong> User <i class="bi bi-person"></i>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="row pb-4">
                    <div class="col">
                        <a href="{{url('/user/add')}}" class="btn btn-primary btn-sm"> 
                            Tambah User <i class="bi bi-plus-circle"></i> 
                        </a>
                    </div>
                    <div class="col">
                        <form action="">
                            {{-- <label for="search" class="form-label"><strong>Cari Data</strong> UMKM</label><br> --}}
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Cari Data User (Nama)...">
                                <button class="btn btn-primary" type="submit">
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
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No Telp</th>
                            <th>Jabatan</th>
                            <th>Level</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($getUser as $item)
                                <tr>
                                    <td>
                                        {{ (($getUser->currentPage() - 1) * $getUser->perPage()) + $loop->iteration }} 
                                    </td>
                                    <td>{{$item->name}} </td>
                                    <td>{{$item->email}} </td>
                                    <td>{{$item->telp}} </td>
                                    <td>{{$item->Jabatan}} </td>
                                    @if ($item->level == 'Super_Admin')
                                        <td>Super Admin</td>
                                    @elseif ($item->level == 'Admin')
                                        <td>Admin</td>
                                    @elseif ($item->level == 'User')
                                        <td>User</td>
                                    @endif
                                    <td class="text-center">
                                        <a href="{{ url('/user/data') }}/{{ $item->id }}" class="btn btn-success btn-sm" title="Lihat Data">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ url('/user/edit') }}/{{ $item->id }}" class="btn btn-warning btn-sm" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href="{{ url('/user/password') }}/{{ $item->id }}" class="btn btn-info btn-sm" title="Ubah Password">
                                            <i class="bi bi-key"></i>
                                        </a>
                                        <a href="{{ url('/user/destroy') }}/{{ $item->id }}" class="btn btn-danger btn-sm" title="Hapus"
                                            onclick="return confirm('Hapus Data ???');">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </td>
                                </tr>   
                            @endforeach
                    </tbody>
                </table>
                {{-- <a href="{{url('/admin')}}" class="btn btn-primary">Refresh Page</a> --}}
                {{$getUser->links()}}
            </div>
        </div> 
    </div>
@endsection