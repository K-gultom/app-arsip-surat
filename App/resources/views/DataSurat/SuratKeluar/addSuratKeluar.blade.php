@extends('mainLayout.main')

@section('title')
    Surat Keluar
@endsection

@section('content')

    <div class="container-fluid">
        <h4 class="mb-2">Surat Keluar</h4>
        <nav aria-label="breadcrumb" class="mb-1">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/data/surat-keluar')}}" class="text-decoration-none">Surat Keluar</a></li>
                <li class="breadcrumb-item active" aria-current="page">Surat Keluar Baru</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-8 offset-2">
                <div class="card">
                    <div class="card-header"><strong>Form</strong> Surat Keluar Baru</div>
                    <div class="card-body">
                        <form action="{{ url('/surat-keluar/add') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <table class="table">
                                <tr>
                                    <td>Nomor Surat</td>
                                    <td>:</td>
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
                                </tr>
                                <tr>
                                    <td>Tanggal Surat</td>
                                    <td>:</td>
                                    <td>
                                        <div class="form-outline">
                                            <input value="{{old('tgl_surat')}}" type="date" name="tgl_surat" id="tgl_surat" class="form-control @error('tgl_surat') is-invalid @enderror" autocomplete="on"/>
                                            @error('tgl_surat')
                                              <div class="invalid-feedback">
                                                {{$message}}
                                              </div>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Perihal</td>
                                    <td>:</td>
                                    <td>
                                        <div class="form-outline">
                                            <input value="{{old('perihal')}}" type="text" name="perihal" id="perihal" class="form-control @error('perihal') is-invalid @enderror" placeholder="Perihal Surat" autocomplete="off"/>
                                            @error('perihal')
                                              <div class="invalid-feedback">
                                                {{$message}}
                                              </div>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Penerima</td>
                                    <td>:</td>
                                    <td>
                                        <div class="form-outline">
                                            <select name="penerima" class="form-control @error('penerima') is-invalid @enderror" id="penerima">
                                                <option value="">Penerima Surat</option>
                                                @foreach ($getPenerima as $penerima)
                                                    <option value="{{ $penerima->id }}" {{ old('penerima') == $penerima->id ? 'selected' : '' }}>
                                                        {{ $penerima->nama_bagian }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('penerima')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td>Pengirim</td>
                                    <td>:</td>
                                    <td>
                                        <div class="form-outline">
                                            <select name="pengirim" class="form-control @error('pengirim') is-invalid @enderror" id="pengirim">
                                                <option value="">Pengirim Surat</option>
                                                @foreach ($getPengirim as $pengirim)
                                                    <option value="{{ $pengirim->id }}" {{ old('pengirim') == $pengirim->id ? 'selected' : ''}}>
                                                        {{ $pengirim->Jabatan }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('pengirim')
                                              <div class="invalid-feedback">
                                                {{$message}}
                                              </div>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>File Surat</td>
                                    <td>:</td>
                                    <td>
                                        <div class="form-outline">
                                            <input value="{{old('file_surat')}}" type="file" name="file_surat" id="file_surat" class="mb-1 form-control @error('file_surat') is-invalid @enderror" autocomplete="off"/>
                                            <p class="text-danger"><sup><strong>File Surat Harus Bertipe PDF!!!</strong></sup></p>
                                            @error('file_surat')
                                              <div class="invalid-feedback">
                                                {{$message}}
                                              </div>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <button type="submit" class="btn btn-primary btn-sm">Simpan <i class="bi bi-check-lg"></i></button>
                            <button type="reset" class="btn btn-warning btn-sm">Reset <i class="bi bi-x"></i></button>
                            <a href="{{ url('/data/surat-keluar') }}" class="btn btn-success btn-sm mx-2">Kembali <i class="bi bi-arrow-return-left"></i></a>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection