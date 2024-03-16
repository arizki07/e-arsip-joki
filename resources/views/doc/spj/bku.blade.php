<!DOCTYPE html>
<html>

<head>
    <title>SPJ BKU</title>
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
                        <div class="tebal" style="font-size: 22px;">BUKU KAS UMUM BPP</div>
                        <div class="tebal" style="font-size: 22px;"><?= strtoupper($bku->bulan) ?></div>
                    </td>
                </tr>
            </table>
            <hr class="garis">
        </div>

        <div class="table-container">
            <table class="table-bawah" style="border: 2px; font-size: 10pt; width: 685px; margin: auto;">
                <tbody>
                    <tr>
                        <td style="width: 170px;">Satuan Perangkat Kerja Daerah</td>
                        <td style="width: 5px; padding: 3px;">:</td>
                        <td class="data-value">SATUAN POLISI PAMONG PRAJA</td>
                    </tr>
                    <tr>
                        <td>Nama & Kode Program</td>
                        <td style="width: 5px; padding: 3px;">:</td>
                        <td class="data-value">PROGRAM PENUNJANG URUSAN PEMERINTAHAN DAERAH KABUPATEN KOTA</td>
                    </tr>
                    <tr>
                        <td>Nama & Kode Kegiatan</td>
                        <td style="width: 5px; padding: 3px;">:</td>
                        <td class="data-value">{{ $bku->kegiatan }}</td>
                    </tr>
                    <tr>
                        <td>Nama & Kode Sub Kegiatan</td>
                        <td style="width: 5px; padding: 3px;">:</td>
                        <td class="data-value">{{ $bku->p_sub_kegiatan }}</td>
                    </tr>
                    <tr>
                        <td>KPA</td>
                        <td style="width: 5px; padding: 3px;">:</td>
                        <td class="data-value">{{ $bku->nama_kpa }}</td>
                    </tr>
                    <tr>
                        <td>PPTK</td>
                        <td style="width: 5px; padding: 3px;">:</td>
                        <td class="data-value">{{ $bku->nama_pptk }}</td>
                    </tr>
                    <tr>
                        <td>BPP</td>
                        <td style="width: 5px; padding: 3px;">:</td>
                        <td class="data-value">{{ $bku->nama_bpp }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div>
            <table class="table-bawah" style="font-size: 10pt; width: 670px; margin: auto; margin-top: 10px;">
                <thead>
                    <tr>
                        <th>No Urut</th>
                        <th>Tanggal</th>
                        <th>Uraian</th>
                        <th>Kode Rekening</th>
                        <th>Penerimaan (Rp)</th>
                        <th>Pengeluaran (Rp)</th>
                        <th>Saldo (Rp)</th>
                        <th>Ket</th>
                    </tr>
                    <tr>
                        <th>1</th>
                        <th>2</th>
                        <th>3</th>
                        <th>4</th>
                        <th>5</th>
                        <th>6</th>
                        <th>7</th>
                        <th>8</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($queryUraianBku as $urbku)
                    <tr>
                        <td style="border: 1px solid #000; padding: 3px;">{{ $urbku->no_urut }}</td>
                        <td style="border: 1px solid #000; padding: 3px;">{{ \Carbon\Carbon::parse($urbku->tanggal)->format('d F Y') }}</td>
                        <td style="border: 1px solid #000; padding: 3px;">{{ $urbku->uraian }}</td>
                        <td style="border: 1px solid #000; padding: 3px;">{{ $urbku->kode_rekening }}</td>
                        <td style="border: 1px solid #000; padding: 3px;">
                            @if ($urbku->penerimaan !== '-')
                                {{ number_format($urbku->penerimaan, 0, ',', '.') }}
                            @else
                                {{ $urbku->penerimaan }}
                            @endif
                        </td>
                        <td style="border: 1px solid #000; padding: 3px;">
                            @if ($urbku->pengeluaran !== '-')
                                {{ number_format($urbku->pengeluaran, 0, ',', '.') }}
                            @else
                                {{ $urbku->pengeluaran }}
                            @endif
                        </td>
                        <td style="border: 1px solid #000; padding: 3px;">
                            @if ($urbku->saldo !== '-')
                                {{ number_format($urbku->saldo, 0, ',', '.') }}
                            @else
                                {{ $urbku->saldo }}
                            @endif
                        </td>
                        <td style="border: 1px solid #000; padding: 3px;">{{ $urbku->keterangan }}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="2" style="border-left: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; border-top: 3px solid #000; padding: 3px; font-weight: bold; text-align: center;"></td>
                        <td colspan="2" style="border-left: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; border-top: 3px solid #000; padding: 3px; font-weight: bold; text-align: center;">Jumlah</td>
                        <td style="border-left: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; border-top: 3px solid #000; padding: 3px; font-weight: bold; text-align: center;">{{ number_format($totalPenerimaanBku, 0, ',', '.') }}</td>
                        <td style="border-left: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; border-top: 3px solid #000; padding: 3px; font-weight: bold; text-align: center;">{{ number_format($totalPengeluaranBku, 0, ',', '.') }}</td>
                        <td style="border-left: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; border-top: 3px solid #000; padding: 3px; font-weight: bold; text-align: center;">{{ number_format($totalSaldo, 0, ',', '.') }}</td>
                        <td style="border-left: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; border-top: 3px solid #000; padding: 3px; font-weight: bold; text-align: center;">-</td>
                    </tr>    
                </tbody>
            </table>
        </div>

        <div class="table-container">
            <table class="table-bawah" style="border: 2px; font-size: 10pt; width: 670px; margin: auto;">
                <tbody>
                    <tr>
                        <td class="data-value" colspan="2">Pada Hari  ini   {{ \Carbon\Carbon::now()->locale('id')->isoFormat('D') }}   tanggal  {{ \Carbon\Carbon::now()->locale('id')->isoFormat('D') }}  Bulan  {{ \Carbon\Carbon::now()->locale('id')->isoFormat('MMMM') }}  Tahun  {{ \Carbon\Carbon::now()->locale('id')->isoFormat('YYYY') }} ( {{ \Carbon\Carbon::now()->locale('id')->isoFormat('D MMMM YYYY') }} )  Oleh  kami   didapat   dalam   kas   sebasar Rp  0,00  <b>(Nol Rupiah)</b> Terdiri Dari :
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 100px;">A. Tunai</td>
                        <td class="data-value">Rp -</td>
                    </tr>
                    <tr>
                        <td>B. Saldo Bank</td>
                        <td class="data-value">Rp -</td>
                    </tr>
                    <tr>
                        <td>B. SP2D</td>
                        <td class="data-value">Rp -</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="table-container">
            <table style="border: 5px; font-size: 10pt; width: 670px; margin: auto;">
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
                            <strong style="text-decoration: underline;">{{ $bku->nama_kpa }}</strong><br>
                            <label>NIP. {{ $bku->nip_kpa }}</label>
                        </td>
                        <td class="data-value-center">
                            Bendahara Pengeluaran Pembantu<br><br><br><br><br><br>
                            <strong style="text-decoration: underline;">{{ $bku->nama_bpp }}</strong><br>
                            <label>NIP. {{ $bku->nip_bpp }}</label>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>