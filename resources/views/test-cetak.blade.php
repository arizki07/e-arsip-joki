<!DOCTYPE html>
<html>

<head>
    <title>SPJ PENGANTAR</title>
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

        .table-bawah td {
            border: 0px; /* Batas setiap sel */
            padding: 8px;
            text-align: left;
        }

        .td-bawah-second {
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
            width: 150px;
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
                        <img src="https://upload.wikimedia.org/wikipedia/commons/6/6f/Logo_of_Twitter.svg" class="logo" alt="Logo">
                    </td>
                    <td class="td-atas">
                        <div class="tebal" style="font-size: 22px;">PEMERINTAH DAERAH KOTA CIREBON</div>
                        <div class="tebal" style="font-size: 22px;">SATUAN POLISI PAMONG PRAJA</div>
                        <div class="tebal">
                            {{-- <font style="font-size: 14px;">JL. Pangesran Drajat No. 49 Cirebon</font> --}}
                        </div>
                    </td>
                </tr>
            </table>
            <hr class="garis">
        </div>
        <div class="header-content">
            <h3 style="font-size: 14pt;"><strong><u>FORMULIR PERMINTAAN PEMBAYARAN UP/GU/TU</u></strong></h3>
        </div>
        <div class="table-container">
            <table class="table-bawah" style="border: 0px; font-size: 12pt; width: 620px; margin: auto;">
                <tbody>
                    @foreach($spp as $sp)
                    <tr>
                        <td class="data-value-1">Nomor</td>
                        <td class="data-value">: {{ $sp->nomor_surat }}</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>Cirebon, {{ \Carbon\Carbon::now()->locale('id')->isoFormat('D MMMM YYYY') }}</td>
                    </tr>
                    <tr>
                        <td class="data-value-1">Sifat</td>
                        <td class="data-value">: {{ $sp->sifat }}</td>
                    </tr>
                    <tr>
                        <td class="data-value-1">Lampiran</td>
                        <td class="data-value">: {{ $sp->lampiran }}</td>
                    </tr>
                    <tr>
                        <td class="data-value-1">Perihal</td>
                        <td class="data-value">: {{ $sp->perihal }}</td>
                    </tr>
                    <tr>
                        <td class="data-value-1"></td>
                        <td class="data-value"></td>
                    </tr>
                    <tr>
                        <td class="data-value" colspan="2">Bersama ini kami sampaikan Surat Pertanggung Jawaban (SPJ) Panjar :</td>
                    </tr>
                    <tr>
                        <td class="data-value-1">Kegiatan</td>
                        <td class="data-value">: {{ $sp->kegiatan }}</td>
                    </tr>
                    <tr>
                        <td class="data-value-1">Sebesar</td>
                        <td class="data-value">: Rp {{ number_format($sp->biaya, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td class="data-value-1"></td>
                        <td class="data-value"></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <table>
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
                    <tr>
                        <td>{{ $number++; }}</td>
                    </tr>
                </tbody>
            </table>
            <table style="border: 5px; font-size: 12pt; width: 620px; margin: auto;">
                <tbody>
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
                    <tr>
                        <td class="data-value-center">
                            Mengetahui/Menyetujui<br>
                            Pengguna Anggaran<br><br><br><br><br>
                        </td>
                        <td style="text-align: center;">
                            <div style="text-align: left; display: inline-block;">
                                <strong>Catatan PA:</strong> Nilai SPJ sesuai<br>dengan permintaan pembayaran<br><br>
                                Paraf Verifikasi:<br><br><br><br><br>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>