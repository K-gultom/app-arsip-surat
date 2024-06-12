@extends('mainLayout.main')

@section('title')
    Surat Keluar
@endsection

@section('content')

    <div class="container-fluid">
        <h4 class="mb-2">Surat Keluar</h4>
        <nav aria-label="breadcrumb" class="mb-1">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/surat-keluar')}}" class="text-decoration-none">Surat Keluar</a></li>
                <li class="breadcrumb-item"><a href="{{url('/surat-usaha')}}" class="text-decoration-none">Surat Usaha</a></li>
                <li class="breadcrumb-item active" aria-current="page">Surat Usaha Baru</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header"><strong>Form</strong> Surat Keterangan Usaha</div>
                    <div class="card-body">
                        <form action="{{ url('/surat-usaha/add') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-4" style="border-bottom: 1px solid gray">
                                <div class="col">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td>Tanda Tangan</td>
                                            <td>
                                                <div class="form-outline">
                                                    <div class="input-group">
                                                        <select name="tanda_tangan" class="form-control @error('pengirim') is-invalid @enderror" id="pengirim">
                                                            <option value=""></option>
                                                            @foreach ($getUser as $tandaTangan)
                                                                <option value="{{ $tandaTangan->id }}" {{ old('tanda_tangan') == $tandaTangan->id ? 'selected' : ''}}>
                                                                    {{ $tandaTangan->Jabatan }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    <span class="input-group-text"><i class="bi bi-caret-down-fill"></i></span>
                                                    </div>
                                                    @error('tanda_tangan')
                                                      <div class="invalid-feedback">
                                                        {{$message}}
                                                      </div>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td>Tanggal Buat Surat</td>
                                            <td>
                                                <div class="form-outline">
                                                    <input value="{{old('tanggal_surat_dibuat')}}" type="date" name="tanggal_surat_dibuat" id="tanggal_surat_dibuat" class="form-control @error('tanggal_surat_dibuat') is-invalid @enderror" autocomplete="off"/>
                                                    @error('tanggal_surat_dibuat')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                        {{-- <tr>
                                            <td>Nomor Surat</td>
                                            <td>
                                                <div class="form-outline">
                                                    <input value="{{old('nomor_surat')}}" type="text" name="nomor_surat" id="nomor_surat" class="form-control @error('nomor_surat') is-invalid @enderror" autocomplete="on"/>
                                                    @error('nomor_surat')
                                                      <div class="invalid-feedback">
                                                        {{$message}}
                                                      </div>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr> --}}
                                    </table>
                                </div>
                            </div>


                            <div class="row mb-4">
                                <div class="col">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td>Nama Lengkap</td>
                                            <td>
                                                <div class="form-outline">
                                                    <input value="{{old('nama_lengkap')}}" type="text" name="nama_lengkap" id="nama_lengkap" class="form-control @error('nama_lengkap') is-invalid @enderror" autocomplete="off"/>
                                                    @error('nama_lengkap')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
        
                                        <tr>
                                            <td>NIK</td>
                                            <td>
                                                <div class="form-outline">
                                                    <input type="text" value="{{ old('nik') }}" name="nik" id="nik" class="form-control @error('nik') is-invalid @enderror" maxlength="16" oninput="validateLength(this)"/>
                                                    @error('nik')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <script>
                                                    // Hanya bisa menerima inputan maximal 16 karakter
                                                    function validateLength(input) {
                                                        if (input.value.length > 16) {
                                                            input.value = input.value.slice(0, 16);
                                                        }
                                                    }
                                                </script>
                                            </td>
                                        </tr>
        
                                        <tr>
                                            <td>Tempat Lahir</td>
                                            <td>
                                                <div class="form-outline">
                                                    <input value="{{old('tempat_lahir')}}" type="text" name="tempat_lahir" id="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror" autocomplete="off"/>
                                                    @error('tempat_lahir')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
        
                                        <tr>
                                            <td>Tanggal Lahir</td>
                                            <td>
                                                <div class="form-outline">
                                                    <input value="{{old('tgl_lahir')}}" type="date" name="tgl_lahir" id="tgl_lahir" class="form-control @error('tgl_lahir') is-invalid @enderror" autocomplete="off"/>
                                                    @error('tgl_lahir')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Alamat</td>
                                            <td>
                                                <div class="form-outline">
                                                    <input value="{{old('alamat')}}" type="text" name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror" autocomplete="off"/>
                                                    @error('alamat')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>


                                <div class="col">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td>Jenis Kelamin</td>
                                            <td>
                                                <div class="form-outline">
                                                    <div class="input-group">
                                                    <select value="{{ old('jenis_kelamin') ?? '' }}" name="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror" id="">
                                                        <option value=""></option>
                                                        <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-Laki</option>
                                                        <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                                    </select>
                                                    <span class="input-group-text"><i class="bi bi-caret-down-fill"></i></span>
                                                    </div>
                                                    @error('jenis_kelamin')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </td>
                                        </tr>
        
                                        <tr>
                                            <td>Pekerjaan</td>
                                            <td>
                                                <div class="form-outline">
                                                    <input value="{{old('pekerjaan')}}" type="text" name="pekerjaan" id="pekerjaan" class="form-control @error('pekerjaan') is-invalid @enderror" autocomplete="off"/>
                                                    @error('pekerjaan')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
        
                                        <tr>
                                            <td>Tempat Pekerjaan</td>
                                            <td>
                                                <div class="form-outline">
                                                    <input value="{{old('tempat_pekerjaan')}}" type="text" name="tempat_pekerjaan" id="tempat_pekerjaan" class="form-control @error('tempat_pekerjaan') is-invalid @enderror" autocomplete="off" placeholder="**Isi jika bekerja di tempat lain"/>
                                                    @error('tempat_pekerjaan')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
        
                                        <tr>
                                            <td>Bidang Usaha</td>
                                            <td>
                                                <div class="form-outline">
                                                    <input value="{{old('bidang_usaha')}}" type="text" name="bidang_usaha" id="bidang_usaha" class="form-control @error('bidang_usaha') is-invalid @enderror" autocomplete="off"/>
                                                    @error('bidang_usaha')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                        
                                        {{-- <tr>
                                            <td>Tanggal Buat Surat</td>
                                            <td>
                                                <div class="form-outline">
                                                    <input value="{{old('tanggal_surat_dibuat')}}" type="date" name="tanggal_surat_dibuat" id="tanggal_surat_dibuat" class="form-control @error('tanggal_surat_dibuat') is-invalid @enderror" autocomplete="off"/>
                                                    @error('tanggal_surat_dibuat')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr> --}}
    
                                    </table>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-sm">Simpan <i class="bi bi-check-lg"></i></button>
                            <button type="reset" class="btn btn-warning btn-sm">Reset <i class="bi bi-x"></i></button>
                            <a href="{{ url('/surat-usaha') }}" class="btn btn-success btn-sm mx-2">Kembali <i class="bi bi-arrow-return-left"></i></a>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection