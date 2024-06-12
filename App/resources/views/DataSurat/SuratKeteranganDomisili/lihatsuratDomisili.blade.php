@extends('mainLayout.main')

@section('title')
    Surat Keluar
@endsection

@section('content')
    <div class="container-fluid">
        <h4 class="mb-3">Surat Keluar</h4>
        <nav aria-label="breadcrumb" class="mb-1">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/surat-keluar')}}" class="text-decoration-none">Surat Keluar</a></li>
                <li class="breadcrumb-item"><a href="{{url('/surat-domisili')}}" class="text-decoration-none">Surat Keterangan Domisili</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data Surat Keterangan Domisili</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-8 offset-2">
                <div class="card">
                    <div class="card-header"><strong>Data</strong> Surat</div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <td width="200px">Nomor Surat</td>
                                <td>:</td>
                                <td>{{ $getData->nomor_surat }}</td>
                            </tr>
                            <tr>
                                <td>Tanggal Surat</td>
                                <td>:</td>
                                <td>{{Carbon\Carbon::parse($getData->tgl_surat_dibuat)->format('d-m-Y') }}</td>
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
                                <td>Tempat/Tgl Lahir</td>
                                <td>:</td>
                                <td>{{ $getData->tempat_lahir }}, {{ Carbon\Carbon::parse($getData->tgl_lahir)->format('d-m-Y') }}</td>
                            </tr>
                            <tr>
                                <td>Kewarganegaraan</td>
                                <td>:</td>
                                <td>
                                    @if ( $getData->kewarganegaraan == 'WNI') 
                                        WNI
                                    @else
                                        WNA
                                    @endif
                                </td>
                                
                            </tr>
                            <tr>
                                <td>Status Perkawinan</td>
                                <td>:</td>
                                <td>
                                    @if ( $getData->status_perkawinan == 'Kawin') 
                                        Kawin
                                    @elseif ($getData->status_perkawinan == 'Belum_Kawin')
                                        Belum Kawin
                                    @elseif ($getData->status_perkawinan == 'Cerai')
                                        Cerai
                                    @endif
                                </td>
                                
                            </tr>
                            <tr>
                                <td>Agama</td>
                                <td>:</td>
                                <td>
                                    @if ( $getData->agama == 'Islam') 
                                        Islam
                                    @elseif ($getData->agama == 'Khatolik')
                                        Khatolik
                                    @elseif ($getData->agama == 'Kristen')
                                        Kristen
                                    @elseif ($getData->agama == 'Buddha')
                                        Buddha
                                    @elseif ($getData->agama == 'Hindu')
                                        Hindu
                                    @elseif ($getData->agama == 'Agama_Kepercayaan')
                                        Agama Kepercayaan
                                    @endif
                                </td>
                                
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>:</td>
                                <td>{{ $getData->alamat }}</td>
                            </tr>
                            <tr>
                                <td>Pekerjaan</td>
                                <td>:</td>
                                <td>{{ $getData->pekerjaan_pemohon }}</td>
                            </tr>
                        </table>
                        <a href="{{ url('/surat-domisili') }}" class="btn btn-success btn-sm">Kembali <i class="bi bi-arrow-return-left"></i></a>
                    </div>
                </div>  
            </div>
        </div>
    </div>
@endsection
