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
                <li class="breadcrumb-item active" aria-current="page">Edit Surat Masuk</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-8 offset-2">
                <div class="card">
                    <div class="card-header"><strong>Form</strong> Edit Surat</div>
                    <div class="card-body">
                        <form action="{{ url('/surat-masuk/edit') }}/{{ $getDataEditSM->id }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <table class="table">
                                <tr>
                                    <td>Nomor Surat</td>
                                    <td>:</td>
                                    <td>
                                        <div class="form-outline">
                                            <input value="{{old('nomor_surat', $getDataEditSM->nomor_surat)}}" type="text" name="nomor_surat" id="nomor_surat" class="form-control @error('nomor_surat') is-invalid @enderror" autocomplete="on"/>
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
                                            <input  value="{{ old('tgl_surat', \Carbon\Carbon::parse($getDataEditSM->tgl_surat)->format('Y-m-d')) }}" type="date" name="tgl_surat" id="tgl_surat" class="form-control @error('tgl_surat') is-invalid @enderror" autocomplete="on"/>
                                            @error('tgl_surat')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td>Perihal</td>
                                    <td>:</td>
                                    <td>
                                        <div class="form-outline">
                                            <input value="{{old('perihal', $getDataEditSM->perihal)}}" type="text" name="perihal" id="perihal" class="form-control @error('perihal') is-invalid @enderror" placeholder="Perihal Surat" autocomplete="off"/>
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
                                                    <option value="{{ $penerima->id }}" {{ old('penerima', $getDataEditSM->penerima) == $penerima->id ? 'selected' : '' }}>
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
                                                    <option value="{{ $pengirim->id }}" {{ old('pengirim', $getDataEditSM->pengirim) == $pengirim->id ? 'selected' : ''}}>
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
                                            <a class="btn btn-outline-warning btn-sm mb-3 " href="{{ asset('/assets/SuratMasuk/' . $getDataEditSM->file_surat) }}" target="_blank">Lihat File Surat saat Ini</a>
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
                            <button type="submit" class="btn btn-primary btn-sm">Update</button>
                            {{-- <button type="reset" class="btn btn-warning btn-sm">Reset</button> --}}
                            <a href="{{ url('/data/surat-masuk') }}" class="btn btn-success btn-sm">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection