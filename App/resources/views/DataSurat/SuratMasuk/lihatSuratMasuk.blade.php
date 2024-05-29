@extends('mainLayout.main')

@section('title')
    Surat Masuk
@endsection

@section('content')
    <div class="container-fluid">
        <h4 class="mb-3">Surat Masuk</h4>
        <nav aria-label="breadcrumb" class="mb-1">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/data/surat-masuk')}}" class="text-decoration-none">Surat Masuk</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data Surat</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-8 offset-2">
                <div class="card">
                    <div class="card-header"><strong>Data</strong> Surat</div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <td>Nomor Surat</td>
                                <td>:</td>
                                <td>{{ $getSuratMasuk->nomor_surat }}</td>
                            </tr>
                            <tr>
                                <td>Tanggal Surat</td>
                                <td>:</td>
                                <td>{{ $getSuratMasuk->tgl_surat }}</td>
                            </tr>
                            <tr>
                                <td>Perihal</td>
                                <td>:</td>
                                <td>{{ $getSuratMasuk->perihal }}</td>
                            </tr>
                            <tr>
                                <td>Penerima</td>
                                <td>:</td>
                                <td>
                                    @if($getSuratMasuk->getPenerima->nama_bagian)
                                        {{ $getSuratMasuk->getPenerima->nama_bagian }}
                                    @else
                                        Data pengirim tidak tersedia
                                    @endif
                                </td>
                                
                            </tr>
                            <tr>
                                <td>Pengirim</td>
                                <td>:</td>
                                <td>
                                    @if($getSuratMasuk->getPengirim)
                                        {{ $getSuratMasuk->getPengirim->Jabatan }}
                                    @else
                                        Data pengirim tidak tersedia
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>File Surat</td>
                                <td>:</td>
                                <td>
                                    <a class="btn btn-outline-info btn-sm" href="{{ asset('/assets/SuratMasuk/' . $getSuratMasuk->file_surat) }}" target="_blank">File PDF Surat</a>
                                </td>
                            </tr>
                        </table>
                        <a href="{{ url('/data/surat-masuk') }}" class="btn btn-warning btn-sm">Kembali</a>
                    </div>
                </div>  
            </div>
        </div>
    </div>
@endsection
