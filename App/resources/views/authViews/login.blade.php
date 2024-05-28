{{-- <head>
    <link rel="icon" href="favicon.ico">
</head> --}}
@extends('authViews.main-login')
@section('title')
    Login
@endsection 

@section('content')


<style>

    .form{
        margin: 170px auto;
    }

</style>
    <div class="container-fluid">
        <div class="container">
            <div class="form row">
                <div class="col-md-4 offset-md-4">
                    <div class="card mt-3">
                        <div class="card-header text-center">
                            <h4><strong >Login</strong></h4>
                            <h6>Aplikasi Surat Masuk-Surat Keluar</h6>
                        </div>
                        <div class="card-body">
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
                                    <label for="email" class="mb-2">Username</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                                        <input value="{{ old('email')}}" type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan Username Anda ... ">
                                    </div>
                                    {{-- <input  value="{{old('email')}}" type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"  placeholder="Masukkan Username Anda ... "> --}}
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @endif
                                </div>
            
                                <div class="mb-3">
                                    <label for="password" class="mb-2">Password</label><br>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-key-fill"></i></span>
                                        <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan Password Anda ... ">
                                    </div>
                                    {{-- <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan Password Anda ... "> --}}
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @endif
                                </div>

                                <button type="submit" class="btn btn-primary w-100">
                                    {{-- Login <i class="bi bi-box-arrow-in-left"></i> --}}
                                    <i class="bi bi-box-arrow-in-right"></i> Login
                                </button>    
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>        
        </div>
    </div>

@endsection