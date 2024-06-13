<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Surat Keteranga Usaha</title>
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
                font-size: 18px;
                font-weight: bolder;
                text-align: center;
            }
            .laporan{
                font-size: 20px;
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

            .tab p {
                text-align: justify;
                text-indent: 2em; /* Anda dapat mengubah nilai ini sesuai kebutuhan */
            }

            .kedua{
                margin-left: 100px;
            }

            .tanda_tangan {
                /* background-color: red; */
                max-width: 400px;
                margin-left: 60%;
                text-align: right;
                margin-right: 35px; /* Anda bisa menyesuaikan nilai ini sesuai kebutuhan */
                display: flex; /* Mengubah display menjadi flex */
                justify-content: flex-end; /* Menggeser konten ke kanan */
                align-items: center; /* Mengatur elemen ke tengah vertikal */
            }

            .tanda_tangan p {
                margin: 0; /* Menghapus margin default pada elemen <p> */
                text-align: center; /* Mengatur teks dalam elemen <p> menjadi center */
            }


            .nama_pembuat{
               /* background-color: red; */
                max-width: 400px;
                margin-left: 45%;
                text-align: right;
                margin-right: 35px; /* Anda bisa menyesuaikan nilai ini sesuai kebutuhan */
                display: flex; /* Mengubah display menjadi flex */
                justify-content: flex-end; /* Menggeser konten ke kanan */
                align-items: center; /* Mengatur elemen ke tengah vertikal */
            }
            .nama_pembuat p {
                margin: 0; /* Menghapus margin default pada elemen <p> */
                text-align: center; /* Mengatur teks dalam elemen <p> menjadi center */
            }

        </style>
    </head>

    <body>
        
        <table class="tabelKopSurat">
            <tr class="barisKop">
                <td class="kanan"><img class="abc" src="assets/images/bende.jpg" alt=""></td>
                <td class="kiri">
                    <div class="pemprov">PEMERINTAH KABUPATEN OGAN KEMERING ILIR</div>
                    <div class="oki">KECAMATAN MESUJI</div>
                    <div  class="laporan">DESA KARYA MUKTI</div>
                    <div  class="desa">
                        <i>alamat: Jln. LINTAS C5 Desa Karya Mukti Kec. Mesuji OKI Kode Pos 30681</i>
                    </div>
                </td>
            </tr>
        </table>

        <div class="container">
            <center>
                <h3><u>SURAT KETERANGAN DOMISILI</u></h3>Nomor: {{ $getData->nomor_surat }}
            </center>
        </div>

        <div class="awal tab" style="text-align: justify">
            <p>Yang bertanda tangan dibawah ini Kepala Desa Karya Mukti,Kecamatan Mesuji Kabupaten Ogan Komering Ilir, menerangkan bahwa :</p>
        </div>

        <div class="kedua">
            <table>
                <tr>
                    <td width="200px">Nama</td>
                    <td width="15px">:</td>
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
                    <td>Pekerjaan</td>
                    <td>:</td>
                    <td>{{ $getData->pekerjaan_pemohon }}</td>
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
                    <td>Alamat</td>
                    <td>:</td>
                    <td>{{ $getData->alamat }}</td>
                </tr>
            
            </table>
        </div>

        <div class="ketiga tab" style="text-align: justify">
            <p>
                Bahwa Nama tersebut diatas adalah benar bertempat tinggal/ Berdomisili di Desa Karya Mukti, Kecamatan Mesuji Kabupaten Ogan Komering Ilir.
            </p>
        </div>

        {{-- <div class="keempat">
            <ul>
                <li>{{ $getData->bidang_usaha }}</li>

                @if ($getData->tempat_pekerjaan)
                    <li>{{ $getData->tempat_pekerjaan }}</li>
                @else
                    
                @endif
            </ul>
        </div> --}}

        <div class="kelima tab" style="text-align: justify">
            <p>
                Demikian Surat Keterangan Domisili ini dibuat dengan sebenarnya untuk dapat dipergunakan sesuai keperluan.
            </p>
        </div>

        <br><br><br><br>
        <div class="tanda_tangan">
            <p>
                <table>
                    <tr>
                        <td>
                            Dibuat di
                        </td>
                        <td>:</td>
                        <td>
                            Karya Mukti
                        </td>
                    </tr>
                    <tr>
                        <td>Pada Tanggal</td>
                        <td>:</td>
                        <td><span>{{ $tanggal_Surat }}</span></td>
                    </tr>
                    <tr>
                        <td colspan="3" center>
                            <span>{{  $getData->getUser->Jabatan }} Karya Mukti</span>
                        </td>
                    </tr>
                </table>
            </p>
        </div>
        
        
<br><br><br>
<br><br><br>
        <div class="nama_pembuat">
            <p> 
                <strong><u>{{ $getData->getUser->name }}</u></strong>
            </p>
        </div>

    </body>
</html>
