@extends('mainLayout.main')

@section('title')
    User
@endsection

@section('content')

    <div class="container-fluid">
        <h4 class="mb-2">Data User</h4>
        <nav aria-label="breadcrumb" class="mb-1">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/user')}}" class="text-decoration-none">Data User</a></li>
                <li class="breadcrumb-item active" aria-current="page">Lihat Data User</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-6 offset-3">
                <div class="card">
                    <div class="card-header"><strong>Data </strong> User</div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <td><strong>Nama</strong></td>
                                <td>:</td>
                                <td>{{ $getData->name }}</td>
                            </tr>
                            <tr>
                                <td><strong>Jabatan</strong></td>
                                <td>:</td>
                                <td>{{ $getData->Jabatan }}</td>
                            </tr>
                            <tr>
                                <td><strong>Email</strong></td>
                                <td>:</td>
                                <td>{{ $getData->email }}</td>
                            </tr>
                            <tr>
                                <td><strong>Alamat</strong></td>
                                <td>:</td>
                                <td>{{ $getData->alamat }}</td>
                            </tr>
                            <tr>
                                <td><strong>Level</strong></td>
                                <td>:</td>
                                <td>
                                    @if ($getData->level == 'Super_Admin')
                                         Super Admin
                                    @elseif ($getData->level == 'Admin')
                                        Admin
                                    @elseif ($getData->level == 'User')
                                        User
                                    @endif
                                </td>
                            </tr>
                        </table>
                        <a href="{{ url('/user') }}" class="btn btn-success mb-2 btn-sm">Kembali <i class="bi bi-arrow-return-left"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection