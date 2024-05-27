@extends('mainLayout.main')

@section('title')
    Surat Masuk
@endsection

@section('content')

    <div class="container-fluid">
        <h4 class="mb-2">Surat Masuk</h4>
        <nav aria-label="breadcrumb" class="mb-1">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/data/surat-masuk')}}" class="text-decoration-none">Surat Masuk</a></li>
                <li class="breadcrumb-item active" aria-current="page">Surat Masuk Baru</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-8 offset-2">
                <div class="card">
                    <div class="card-header"><strong>Tambah</strong> Data</div>
                    <div class="card-body">
                        <form action="" method="post">
                            @csrf
                            <table class="table">
                                {{-- <tr>
                                    <td>Nomor Surat</td>
                                    <td>:</td>
                                    <td>
                                        <div class="form-outline">
                                            <input readonly value="{{old('nomor_surat')}}" type="text" name="nomor_surat" id="nomor_surat" class="form-control @error('nomor_surat') is-invalid @enderror" autocomplete="on"/>
                                            @error('nomor_surat')
                                              <div class="invalid-feedback">
                                                {{$message}}
                                              </div>
                                            @endif
                                        </div>
                                    </td>
                                </tr> --}}
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
                                                    <option value="{{ $penerima->id }}" {{ old('penerima') == $penerima->id}}>
                                                        {{ $penerima->nama_bagian }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('penerima')
                                              <div class="invalid-feedback">
                                                {{$message}}
                                              </div>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Pengirim</td>
                                    <td>:</td>
                                    <td>
                                        <div class="form-outline">
                                            <input value="{{old('pengirim')}}" type="text" name="pengirim" id="pengirim" class="form-control @error('pengirim') is-invalid @enderror" autocomplete="off"/>
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
                            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                            <button type="reset" class="btn btn-warning btn-sm">Reset</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection