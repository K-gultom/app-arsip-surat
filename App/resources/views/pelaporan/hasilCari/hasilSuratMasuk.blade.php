@extends('mainLayout.main')

@section('title')
    Surat Masuk
@endsection

@section('content')
    <div class="container-fluid">
        <h4 class="mb-3">Surat Masuk test</h4>
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
                        <a href="{{ url('/cetak/surat-masuk') }}" class="btn btn-primary">Refresh Data <i class="bi bi-arrow-clockwise"></i></a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="row pb-4">
                    {{-- <div class="col">
                        <button class="btn btn-primary btn-sm">
                            Cetak Surat <i class="bi bi-printer"></i>
                        </button>
                    </div> --}}
                    <div class="col">
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#printModal">
                            Cetak Surat <i class="bi bi-printer"></i>
                        </button>
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
                            <th>No Surat</th>
                            <th>Tgl Surat</th>
                            <th>Perihal</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach ($data as $item) --}}
                            <tr>
                                <td>1</td>
                                <td>KDOKI/2405202401</td>
                                <td>24-05-2024</td>
                                <td>Rapat Semua Ketua RT</td>
                            </tr>
                        {{-- @endforeach --}}
                    </tbody>
                </table>
                {{-- <a href="{{url('/admin')}}" class="btn btn-primary">Refresh Page</a> --}}
                {{-- {{$data->links()}} --}}
            </div>
        </div>
    </div>

    <div class="modal fade" id="printModal" tabindex="-1" aria-labelledby="printModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="printModalLabel">Cetak Surat Masuk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="printArea">
                        <h4>Surat Masuk</h4>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No Surat</th>
                                    <th>Tgl Surat</th>
                                    <th>Perihal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1<td>
                                    <td>dgdfgdfg</td>
                                    <td>fsdfsdsdfhg</td>
                                    <td>sdfsdfsdghsdhsh</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="printContent('printArea')">Print</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function printContent(el) {
            var restorePage = document.body.innerHTML;
            var printContent = document.getElementById(el).innerHTML;
            document.body.innerHTML = printContent;
            window.print();
            document.body.innerHTML = restorePage;
        }
    </script>
    
@endsection
