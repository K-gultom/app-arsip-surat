@extends('mainLayout.main')

@section('title')
    User
@endsection

@section('content')

<style>
    /* .card{
        margin-bottom: 100px;
    } */
</style>

<div class="container-fluid ">
    <h4 class="mb-2">Tambah Data User</h4>
    <nav aria-label="breadcrumb" class="mb-1">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/user')}}" class="text-decoration-none">Data User</a></li>
        <li class="breadcrumb-item active" aria-current="page">Tambah Data User</li>
      </ol>
    </nav>
    
    <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col">
              <strong>Tambah </strong> Data
            </div>
          </div>
        </div>
        
        <div class="card-body">
            @if(Session::has('message'))
              <div class="card alert alert-success">
                {{Session::get('message')}}
              </div>
            @endif
            
            <form action="" method="post">
                @csrf
                
                <div class="row mb-4">
                    <div class="col">
                        <div class="form-outline">
                            <label class="form-label" for="name">Nama Lengkap</label>
                            <input value="{{old('name')}}" type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" autocomplete="on"/>
                              @error('name')
                                <div class="invalid-feedback">
                                  {{$message}}
                                </div>
                              @endif
                          </div>
                    </div>
                    <div class="col">
                        <div class="form-outline">
                            <label class="form-label" for="Jabatan">Jabatan</label>
                            <input value="{{old('Jabatan')}}" type="text" name="Jabatan" Jabatan="Jabatan" id="Jabatan" class="form-control @error('Jabatan') is-invalid @enderror" autocomplete="on" />
                              @error('Jabatan')
                                <div class="invalid-feedback">
                                  {{$message}}
                                </div>
                              @endif
                          </div>
                    </div>
                    
                </div>

                <div class="row">
                    <div class="col">
                        <div class="form-outline mb-4">
                            <label class="form-label" for="alamat">Alamat</label>
                            <input  value="{{old('alamat')}}" type="text" name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror" autocomplete="on" />
                              @error('alamat')
                                <div class="invalid-feedback">
                                  {{$message}}
                                </div>
                              @endif
                          </div>
                    </div>
                    <div class="col">
                        <div class="form-outline mb-4">
                            <label class="form-label" for="telp">No. Telp/WA</label>
                            <input  value="{{old('telp')}}" type="text" name="telp" id="telp" class="form-control @error('telp') is-invalid @enderror" autocomplete="on"/>
                              @error('telp')
                                <div class="invalid-feedback">
                                  {{$message}}
                                </div>
                              @endif
                          </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col">
                      <div class="form-outline">
                        <label class="form-label" for="email">Email</label>
                        <input value="{{old('email')}}" type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Isi dengan Email Anda" autocomplete="on">
                        <h6 class="mt-2"><sup><i>*Email digunakan saat Login ke Sistem</i></sup></h6>
                          @error('email')
                            <div class="invalid-feedback">
                              {{$message}}
                            </div>
                          @endif
                      </div>
                    </div>

                    <div class="col">
                      <div class="form-outline">
                        <label class="form-label" for="password">Password</label>
                        <input type="text" name="password" id="password" class="form-control @error('password') is-invalid @enderror" />
                        <h6 class="mt-2"><sup><i>*Password digunakan saat Login Sistem</i></sup></h6>
                          @error('password')
                            <div class="invalid-feedback">
                              {{$message}}
                            </div>
                          @endif
                      </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <div class="form-outline mb-4">
                            <label class="form-label" for="level">Level User</label>
                            <select name="level" class="form-control @error('level') is-invalid @enderror" id="level">
                                <option value="">Pilih Level User</option>
                                <option value="Super_Admin" {{ old('level') == 'Super_Admin' ? 'selected' : '' }}>Super Admin</option>
                                <option value="Admin" {{ old('level') == 'Admin' ? 'selected' : '' }}>Admin</option>
                                <option value="User" {{ old('level') == 'User' ? 'selected' : '' }}>User</option>
                            </select>
                            @error('level')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-block mb-2 btn-sm">Tambah Data <i class="bi bi-check-lg"></i></button>

                <button type="reset" class="btn btn-warning btn-block mb-2 btn-sm">Reset <i class="bi bi-x"></i></button>

            </form> 
        </div>
    </div>
</div>
@endsection