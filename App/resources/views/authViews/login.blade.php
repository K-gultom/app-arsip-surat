@extends('authViews.main-login')
@section('title')
    Login
@endsection 

@section('content')

<style>
    .form {
        margin: 120px auto;
    }
    .abc .logo-container {
        width: 110px;
        height: 110px;
        border-radius: 50%;
        background: url('{{ url("/assets/images/logo2.jpg") }}') no-repeat center center;
        background-size: cover;
        display: block;
        margin: 0 auto 10px auto;
        border: 1px solid black;
    }
</style>
<div class="container-fluid">
    <div class="container">
        <div class="form row">
            <div class="col-md-4 offset-md-4">
                <div class="card mt-3">
                    {{-- <div class="card-header text-center">
                        
                    </div> --}}

                    <div class="card-body abc">
                       
                        <a href="{{ url('/') }}" class="text-decoration-none" title="Logo Desa Karya Mukti"><div class="logo-container"></div></a>
                        <h4 class="text-center"><strong>Arsip Surat Desa Karya Mukti</strong></h4>
                        <h6 class="text-center mb-5">Isi Sesuai Kolom Dibawah</h6>


                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <form action="{{url('/')}}" method="POST">
                            @csrf
                            <div class="mb-3">
                                {{-- <label for="email" class="mb-2">Username</label> --}}
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                                    <input value="{{ old('email')}}" type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan Email Pengguna" autocomplete="off">
                                </div>
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                {{-- <label for="password" class="mb-2">Password</label><br> --}}
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-key-fill"></i></span>
                                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan Kata Sandi">
                                </div>
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-10 offset-1 mb-3">
                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="bi bi-box-arrow-in-right"></i> Login
                                    </button>    
                                </div>    
                            </div>    
                        </form>



                    </div>
                </div>
            </div>
        </div>        
    </div>
</div>

@endsection
