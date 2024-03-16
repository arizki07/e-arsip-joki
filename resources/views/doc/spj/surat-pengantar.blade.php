<!DOCTYPE html>
<html>

<head>
    <title>SPJ Surat Pengantar</title>
    <style type="text/css">
        body {
            font-family: 'Times New Roman', Times, serif;
        }

        .rangkasurat {
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
        }

        .logo {
            width: 100px;
        }

        .header {
            text-align: center;
            margin-top: 15px;
        }

        .header h2 {
            margin: 0;
            padding: 0;
        }

        .header-content {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
            padding: 0;
        }

        .tebal {
            font-weight: bold;
        }

        .garis {
            border: 2px solid #000;
        }

        .table-container {
            margin-top: 20px;
        }

        .table-bawah {
            border: 0px;
            font-size: 12pt;
            width: 100%;
            margin: auto;
            border-collapse: collapse;
        }

        .border-solid {
            border: 1px solid #000;
        }

        .table-bawah td {
            border: 0px; /* Batas setiap sel */
            padding: 8px;
            text-align: left;
        }

        .td-bawah-second {
            border: 1px solid #000;
            padding: 8px;
        }

        .td-bawah-third {
            border: 1px solid #000;
            padding: 8px;
        }

        .td-bawah {
            border: 1px solid #000;
            padding: 8px;
            font-weight: bold;
        }

        .td-atas {
            margin-right: 50px;
            text-align: center;
        }

        th {
            background-color: #f5f5f5;
            border: 1px solid #000;
        }

        .garis {
            border: 2px solid #000;
        }

        .kontak {
            font-size: 10px;
        }

        .nomor-surat,
        .tgl {
            font-size: 12px;
        }

        .nomor-surat {
            float: left;
        }

        .tgl {
            float: right;
        }

        .nomor-halaman {
            text-align: right;
            font-size: 12px;
            position: absolute;
            bottom: 20px;
            right: 20px;
        }

        .keterangan-kiri {
            position: absolute;
            bottom: 20px;
            left: 20px;
            font-size: 12px;
        }

        .data-table {
            width: 50%;
            margin: 20px auto;
            border-collapse: collapse;
            text-align: center;
        }

        .data-table td {
            padding: 8px;
            border: 1px solid #ddd;
        }

        .data-label {
            font-weight: bold;
            text-align: left;
        }

        .data-value {
            text-align: left;
        }

        .data-value-right {
            text-align: right;
        }

        .data-value-center {
            text-align: center;
        }

        .data-value-1 {
            text-align: left;
            /* width: 150px; */
        }

        /*.additional-info {
            margin-top: 20px;
            text-align: center;
        }*/

        .signatures-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .additional-info {
            text-align: center;
            margin-bottom: 20px;
        }

        .additional-info label {
            display: block;
        }

        .underline {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="rangkasurat">
        <div class="header">
            <table width="100%">
                <tr>
                    <td>
                        <img src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEiXsGdY-avkAVzjcP9GUYIa1OptUFJRekUE3ptUyc73h7OXq9b4GaNzoZy3QctGIE6-Xh_FPaoX384RNxKoSH-IdM9EY7CITk-gsEfd6omADkvB1D_jYBsN2nTikg63REMpvRVGDnLto-7mICmgDDjcaD8zG_h_PLyjnz2-1ZQhHVunmvvpc0UfOA/s320/GKL24_logo-kota-cirebon%20-%20Koleksilogo.com.png"
                            class="logo" alt="Logo">
                    </td>
                    <td class="td-atas">
                        <div class="tebal" style="font-size: 22px;">PEMERINTAH DAERAH KOTA CIREBON</div>
                        <div class="tebal" style="font-size: 22px;">SATUAN POLISI PAMONG PRAJA</div>
                        <div class="tebal">
                            <font style="font-size: 14px;">JL. Pangesran Drajat No. 49 Cirebon</font>
                        </div>
                        <!-- <div class="kontak">
                            E-mail: <font style="color: blue;">smp-2smbr@gmail.com</font> Telp: (021) 2176263 Website: <font style="color: blue;">smpn-2-smbr.sch.id</font>
                        </div> -->
                    </td>
                </tr>
            </table>
            <hr class="garis">
        </div>
        {{-- <div class="header-content">
            <h3 style="font-size: 14pt;"><strong><u>FORMULIR PERMINTAAN PEMBAYARAN TESTING</u></strong></h3>
        </div> --}}
        <div>
            <table class="table-bawah" style="border: 2px; font-size: 10pt; width: 670px; margin: auto;">
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Cirebon, {{ \Carbon\Carbon::now()->locale('id')->isoFormat('D MMMM YYYY') }}</td>
                    </tr>
                    <tr>
                        <td>Nomor</td>
                        <td style="width: 5px;">:</td>
                        <td class="data-value">{{ $surPeng->nomor_surat }}</td>
                        <td>Kepada,</td>
                    </tr>
                    <tr>
                        <td>Sifat</td>
                        <td style="width: 5px;">:</td>
                        <td class="data-value">{{ $surPeng->sifat }}</td>
                        <td>Yth, Bendahara Pengeluaran SATPOL PP</td>
                    </tr>
                    <tr>
                        <td>Lampiran</td>
                        <td style="width: 5px;">:</td>
                        <td class="data-value">{{ $surPeng->lampiran }}</td>
                        <td>Di</td>
                    </tr>
                    <tr>
                        <td>Perihal</td>
                        <td style="width: 5px;">:</td>
                        <td class="data-value">{{ $surPeng->perihal }}</td>
                        <td style="font-weight: bold;">CIREBON</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="table-container">
            <table class="table-bawah" style="border: 2px; font-size: 10pt; width: 670px; margin: auto;">
                <tbody>
                    <tr>
                        <td class="data-value" colspan="3">Bersama ini kami sampaikan Surat Pertanggung Jawaban (SPJ) Panjar :</td>
                    </tr>
                    <tr>
                        <td>Kegiatan</td>
                        <td style="width: 5px;">:</td>
                        <td class="data-value">{{ $surPeng->kegiatan }}</td>
                    </tr>
                    <tr>
                        <td>Sebesar</td>
                        <td style="width: 5px;">:</td>
                        <td class="data-value">Rp {{ number_format($total, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div>
            <table class="table-bawah" style="font-size: 10pt; width: 655px; margin: auto; margin-top: 10px;">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Uraian</th>
                        <th>Jumlah Yang DI SPJ Kan (RP)</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $number = 1;
                    @endphp
                    @foreach ($uraianData as $ur)
                    <tr>
                        <td style="border: 1px solid #000; padding: 3px;">{{ $number++; }}</td>
                        <td style="border: 1px solid #000; padding: 3px;">{{ $ur['uraian'] }}</td>
                        <td style="border: 1px solid #000; padding: 3px;">{{ $ur['jumlah'] }}</td>
                        <td style="border: 1px solid #000; padding: 3px;"></td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="4" style="border-left: 1px solid #000; border-right: 1px solid #000; border-top: 1px solid #000; border-bottom: 3px solid #000; padding: 3px; font-weight: bold; text-align: center;">Jumlah</td>
                    </tr>                    
                    <tr>
                        <td style="border: 1px solid #000; padding: 3px;"></td>
                        <td style="border: 1px solid #000; padding: 3px;">Jumlah Bulan Ini</td>
                        <td style="border: 1px solid #000; padding: 3px;">Rp {{ number_format($total, 0, ',', '.') }}</td>
                        <td style="border: 1px solid #000; padding: 3px;"></td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #000; padding: 3px;"></td>
                        <td style="border: 1px solid #000; padding: 3px;">Jumlah S/d Bulan Lalu</td>
                        <td style="border: 1px solid #000; padding: 3px;"></td>
                        <td style="border: 1px solid #000; padding: 3px;"></td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #000; padding: 3px;"></td>
                        <td style="border: 1px solid #000; padding: 3px;">Jumlah S/d Bulan Ini</td>
                        <td style="border: 1px solid #000; padding: 3px;">Rp {{ number_format($total, 0, ',', '.') }}</td>
                        <td style="border: 1px solid #000; padding: 3px;"></td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #000; padding: 3px;"></td>
                        <td style="border: 1px solid #000; padding: 3px;">Saldo Yang Belum Di SPJ kan</td>
                        <td style="border: 1px solid #000; padding: 3px;"></td>
                        <td style="border: 1px solid #000; padding: 3px;"></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="table-container">
            <table style="border: 5px; font-size: 12pt; width: 670px; margin: auto;">
                <tbody>
                    <tr>
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                        <td class="data-value-center">
                            Mengetahui/Menyetujui<br>
                            Kuasa Pengguna Anggaran<br><br><br><br><br>
                            <strong style="text-decoration: underline;">{{ $surPeng->nama_kpa }}</strong><br>
                            <label>NIP. {{ $surPeng->nip_kpa }}</label>
                        </td>
                        <td class="data-value-center">
                            Bendahara Pengeluaran Pembantu<br><br><br><br><br><br>
                            <strong style="text-decoration: underline;">{{ $surPeng->nama_bpp }}</strong><br>
                            <label>NIP. {{ $surPeng->nip_bpp }}</label>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>