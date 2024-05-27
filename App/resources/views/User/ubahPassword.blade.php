@extends('mainLayout.main')

@section('title')
    User
@endsection

@section('content')

    <div class="container-fluid">
        <h4 class="mb-2">Ganti Password</h4>
        <nav aria-label="breadcrumb" class="mb-1">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/user')}}" class="text-decoration-none">Data User</a></li>
                <li class="breadcrumb-item active" aria-current="page">Ganti Password</li>
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
                                <td>{{ $getData->level }}</td>
                            </tr>
                        </table>
                        <form action="" method="post">
                            @csrf
                            <div class="col">
                                <div class="form-outline">
                                <label class="form-label" for="password">Ubah Password</label>
                                <input type="text" name="password" id="password" class="form-control @error('password') is-invalid @enderror" />
                                <h6 class="mt-2"><sup><i>*Password digunakan saat Login Sistem</i></sup></h6>
                                    @error('password')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm">Update Password <i class="bi bi-check-lg"></i></button>
                            <a href="{{ url('/user') }}" class="btn btn-warning btn-sm">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection