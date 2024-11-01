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
                <li class="breadcrumb-item active" aria-current="page">Data Surat Usaha</li>
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
                                <td>{{ $getData->nomor_surat }}</td>
                            </tr>
                            <tr>
                                <td>Tanggal Surat</td>
                                <td>:</td>
                                <td>{{ $getData->tanggal_surat_dibuat }}</td>
                            </tr>
                            <tr>
                                <td>Nama</td>
                                <td>:</td>
                                <td>{{ $getData->nama_lengkap }}</td>
                            </tr>
                            <tr>
                                <td>NIK</td>
                                <td>:</td>
                                <td>{{ $getData->nik }}</td>
                                
                            </tr>
                            <tr>
                                <td>Tempat/Tgl Lahir</td>
                                <td>:</td>
                                <td>{{ $getData->tempat_lahir }}, {{ Carbon\Carbon::parse($getData->tanggal_surat_dibuat)->format('d-m-Y') }}</td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>:</td>
                                <td>{{ $getData->alamat }}</td>
                                
                            </tr>
                            <tr>
                                <td>Jenis Kelamin</td>
                                <td>:</td>
                                <td>
                                    @if ( $getData->jenis_kelamin == 'L') 
                                        Laki-Laki
                                    @else
                                        Perempuan
                                    @endif
                                </td>
                                
                            </tr>
                            <tr>
                                <td>Pekerjaan</td>
                                <td>:</td>
                                <td>{{ $getData->pekerjaan }}</td>
                                
                            </tr>
                            <tr>
                                <td>Pekerjaan</td>
                                <td>:</td>
                                <td>
                                    @if (is_null($getData->tempat_pekerjaan))
                                        Tidak Bekerja di Tempat Lain
                                    @else
                                        {{ $getData->tempat_pekerjaan }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Bidang Usaha</td>
                                <td>:</td>
                                <td>{{ $getData->bidang_usaha }}</td>
                                
                            </tr>
                        </table>
                        <a href="{{ url('/surat-usaha') }}" class="btn btn-success btn-sm">Kembali <i class="bi bi-arrow-return-left"></i></a>
                    </div>
                </div>  
            </div>
        </div>
    </div>
@endsection
