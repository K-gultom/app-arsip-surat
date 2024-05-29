<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Surat Masuk</title>
    <style>
        body {
            margin: 0%;
            padding: 0%;
            font-family: Arial, sans-serif;
        }
        .dataTable {
            width: 100%;
            border-collapse: collapse;
        }
        .dataTable, .head, .tdData {
            border-color: black;
        }
        .head {
            padding: 8px;
            text-align: center;
            font-size: 14px;
        }
        .tdData {
            padding: 8px;
            text-align: left;
            font-size: 12px;
        }
        .tabelKopSurat{
            /* border: 1px solid black; */
            width: 100%;
            border-collapse: collapse;
            align-items: center;
            text-align: center;
            border-bottom: 1px solid black;
        }
        .abc {
            width: 100px;
            margin-bottom: 10px;
            
        }
        .pemprov{
            font-size: 20px;
            font-weight: bolder;
            text-align: center;
        }
        .oki{
            font-size: 16px;
            font-weight: bolder;
            text-align: center;
        }
        .laporan{
            font-size: 15px;
            font-weight: bolder;
            text-align: center;
        }
        .desa {
            font-size: 12px;
            text-align: center;
        }
        .kanan{
            /* background-color: red; */
            text-align: center;
            align-items: center;
        }
        .kiri{
            line-height: 20px;
        }
        .tanggalLaporan{
            font-size: 15px;
        }
    </style>
</head>
<body>
    
    <table class="tabelKopSurat">
        <tr class="barisKop">
            <td class="kanan"><img class="abc" src="assets/images/logoKop.jpg" alt=""></td>
            <td class="kiri">
                <div class="pemprov">PEMERINTAH DAERAH PROVINSI SUMATERA SELATAN</div>
                <div class="oki">OGAN KOMERING ILIR - DESA KARYA MUKTI</div>
                <div  class="laporan">Laporan Data Surat Masuk</div>
                <div  class="desa">Jl. Poros Desa Karya Mukti Dusun I Blok A,  Kecamatan Mesuji, Kabupaten Ogan Komering Ilir, <br>Sumatera Selatan, 30681, 
                    Telp: 085314597652, Email: <a href="">c5karyamukti@gmail.com</a> </div>
            </td>
        </tr>
    </table>
<br>
    <div class="tanggalLaporan">laporan dari tanggal: {{ \Carbon\Carbon::parse($get1)->format('d-m-Y') }} Sampai: {{ \Carbon\Carbon::parse($get2)->format('d-m-Y') }}</div>
<br>
    <table class="dataTable" border="1">
        <thead>
            <tr>
                <th class="head">No</th>
                <th class="head">Nomor Surat</th>
                <th class="head">Perihal</th>
                <th class="head">Tanggal Surat</th>
                <th class="head">Pengirim</th>
                <th class="head">Penerima</th>
            </tr>
        </thead>
        <tbody>
            @forelse($suratMasuk as $surat)
                <tr>
                    <td class="tdData">{{ $loop->iteration }}</td>
                    <td class="tdData">{{ $surat->nomor_surat }}</td>
                    <td class="tdData">{{ $surat->perihal }}</td>
                    <td class="tdData">{{ \Carbon\Carbon::parse($surat->tgl_surat)->format('d-m-Y') }}</td>
                    <td class="tdData">{{ $surat->getPengirim->Jabatan }}</td>
                    <td class="tdData">{{ $surat->getPenerima->nama_bagian }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Tidak ada data ditemukan antara tanggal {{ \Carbon\Carbon::parse($get1)->format('d-m-Y') }} dan {{ \Carbon\Carbon::parse($get2)->format('d-m-Y') }}</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
