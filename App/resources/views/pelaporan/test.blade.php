<!DOCTYPE html>
<html>
<head>
    <title>Laporan Surat Masuk</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th {
            padding: 8px;
            text-align: center;
        }
        td {
            padding: 8px;
            text-align: left;
        }
        .container {
            text-align: start;
            align-items: flex-start;
            justify-content: center;
            padding: 20px;
            margin-bottom: 20px;
            display: flex;
        }
        .abc {
            width: 100px;
            margin-right: 20px;
        }
        .container h1, .container h3, .container p {
            margin: 0;
        }
        .desa {
            text-align: center;
        }

        /* Ukuran kertas A4 */
        @page {
            size: A4 potrait;
            margin: 0;
        }
        body {
            margin: 1.27cm; /* Set margin sesuai dengan margin fisik A4 */
        }
    </style>
</head>
<body>
    
    <div class="container">
        <img class="abc" src="assets/images/logo.jpg" alt="">
        <div>
            <h1 class="desa">Desa Karya Mukti</h1>
            <h3  class="desa">Laporan Surat Masuk</h3>
            <p  class="desa">Jl. Poros Desa Karya Mukti Dusun I Blok A, <br> Kecamatan Mesuji, Kabupaten Ogan Komering Ilir, <br> Sumatera Selatan, 30681,<br>
                 Telp: 085314597652, Email: c5karyamukti@gmail.com </p>
        </div>
    </div>

    <p>Dari laporan dari tanggal: 12-12-2024 Sampai: 10-10-2024</p>

    <table>
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
            <tr>
                <td>1</td>
                <td>bdfbdr6435yere</td>
                <td>Surat Permohonan</td>
                <td>12-03-2024</td>
                <td>Kaur RT</td>
                <td>Sekretaris</td>
            </tr>
            {{-- @forelse($suratMasuk as $surat)
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
            @endforelse --}}
        </tbody>
    </table>
</body>
</html>
