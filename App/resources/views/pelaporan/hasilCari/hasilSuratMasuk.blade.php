@extends('mainLayout.main')

@section('title')
    Surat Masuk
@endsection

@section('content')
    <div class="container-fluid">
        <h4 class="mb-3">Surat Masuk</h4>
        <nav aria-label="breadcrumb" class="mb-1">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Surat Masuk</li>
            </ol>
        </nav>

        <div class="card">
            <div class="card-header">
                <div class="d-flex">
                    <div class="w-100 pt-1">
                        <strong>Surat</strong> Masuk <i class="bi bi-envelope"></i>
                    </div>
                    <div class="w-100 pt-1 text-end">
                        <a href="{{ url('/pelaporan/surat-masuk') }}" class="btn btn-primary btn-sm">Kembali <i class="bi bi-arrow-clockwise"></i></a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="row pb-4">
                    <div class="col">
                        <form action="{{ url('/cetak/surat-masuk') }}" method="post" target="_blank">
                            @csrf
                            <input hidden type="date" value="{{ $get1 }}" name="awal" id="">
                            <input hidden type="date" value="{{ $get2 }}" name="akhir" id="">
                            <button class="btn btn-primary btn-sm">
                                Cetak Surat <i class="bi bi-printer"></i>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <h5>Hasil Pencarian Surat Masuk</h5>
                        <p>Dari: {{ \Carbon\Carbon::parse($get1)->format('d-m-Y') }} Sampai: {{ \Carbon\Carbon::parse($get2)->format('d-m-Y') }}</p>
                    </div>
                </div>
                @if(session('message'))
                    <div id="flash-message" class="alert alert-success">
                        {{ session('message') }}
                    </div>
                    <script>
                        setTimeout(function() {
                            document.getElementById('flash-message').style.display = 'none';
                        }, {{ session('timeout', 5000) }});
                    </script>
                @endif

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nomor Surat</th>
                            <th>Perihal</th>
                            <th>Tanggal Surat</th>
                            <th>Pengirim</th>
                            <th>Penerima</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($suratMasuk as $surat)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $surat->nomor_surat }}</td>
                                <td>{{ $surat->perihal }}</td>
                                <td>{{ \Carbon\Carbon::parse($surat->tgl_surat)->format('d-m-Y') }}</td>
                                <td>{{ $surat->getPengirim->Jabatan }}</td>
                                <td>{{ $surat->getPenerima->nama_bagian }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">Tidak ada data ditemukan antara tanggal {{ $get1 }} dan {{ $get2 }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{-- <a href="{{url('/admin')}}" class="btn btn-primary">Refresh Page</a> --}}
                {{-- {{$data->links()}} --}}
            </div>
        </div>
    </div>
@endsection
