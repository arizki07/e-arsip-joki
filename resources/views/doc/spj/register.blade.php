<!DOCTYPE html>
<html>

<head>
    <title>SPJ Register Kas</title>
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
                        <div class="tebal" style="font-size: 22px;">REGISTER PENUTUPAN KAS</div>
                    </td>
                </tr>
            </table>
            <hr class="garis">
        </div>

        <div class="table-container">
            <table class="table-bawah" style="border: 2px; font-size: 10pt; width: 685px; margin: auto;">
                <tbody>
                    <tr>
                        <td style="width: 140px;">Tanggal Penutupan</td>
                        <td style="width: 5px; padding: 3px;">:</td>
                        <td class="data-value">{{ \Carbon\Carbon::now()->locale('id')->isoFormat('MMMM YYYY') }}</td>
                        <td style="width: 140px;">Saldo Buku</td>
                        <td style="width: 5px; padding: 3px;">:</td>
                        <td class="data-value">
                            @if ($bku->saldo_buku !== '-')
                                {{ number_format($bku->saldo_buku, 0, ',', '.') }}
                            @else
                                {{ $bku->saldo_buku }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Nama Penutup Kas</td>
                        <td style="width: 5px; padding: 3px;">:</td>
                        <td class="data-value">{{ $bku->nama_kpa }}</td>
                        <td>Saldo Kas/Bank</td>
                        <td style="width: 5px; padding: 3px;">:</td>
                        <td class="data-value">
                            @if ($bku->saldo_kas !== '-')
                                {{ number_format($bku->saldo_kas, 0, ',', '.') }}
                            @else
                                {{ $bku->saldo_kas }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Tanggal Penutupan Lalu</td>
                        <td style="width: 5px; padding: 3px;">:</td>
                        <td class="data-value">{{ $bku->tgl_penutupan_lalu }}</td>
                        <td>Perbedaan Positif/Negatif</td>
                        <td style="width: 5px; padding: 3px;">:</td>
                        <td class="data-value">
                            @if ($bku->positif_negatif !== '-')
                                {{ number_format($bku->positif_negatif, 0, ',', '.') }}
                            @else
                                {{ $bku->positif_negatif }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Jml Seluruh Penerimaan</td>
                        <td style="width: 5px; padding: 3px;">:</td>
                        <td class="data-value">Rp {{ number_format($totalPenerimaan, 0, ',', '.') }}</td>
                        <td>Kertas Berharga</td>
                        <td style="width: 5px; padding: 3px;">:</td>
                        <td class="data-value">{{ $bku->kertas_berharga }}</td>
                    </tr>
                    <tr>
                        <td>Jml Seluruh Pengeluaran</td>
                        <td style="width: 5px; padding: 3px;">:</td>
                        <td class="data-value">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</td>
                        <td>Penjelasan Perbedaan</td>
                        <td style="width: 5px; padding: 3px;">:</td>
                        <td class="data-value">{{ $bku->perbedaan }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div>
            <table class="table-bawah" style="font-size: 10pt; width: 670px; margin: auto; margin-top: 10px;">
                <tr>
                    <th colspan="6" style="text-align: center;">UANG KERTAS
                    </th>
                </tr>
                <tr>
                    <td style="border: 1px solid #000; padding: 3px;">Lembaran Uang Kertas</td>
                    <td style="border: 1px solid #000; padding: 3px;">Rp 100.000,00</td>
                    <td style="border: 1px solid #000; padding: 3px;">x</td>
                    <td style="border: 1px solid #000; padding: 3px;">{{ $bku->kertas_100 }} Lembar</td>
                    <td style="border: 1px solid #000; padding: 3px;">=</td>
                    <td style="border: 1px solid #000; padding: 3px;">Rp -</td>
                </tr>
                <tr>
                    <td style="border: 1px solid #000; padding: 3px;">Lembaran Uang Kertas</td>
                    <td style="border: 1px solid #000; padding: 3px;">Rp 50.000,00</td>
                    <td style="border: 1px solid #000; padding: 3px;">x</td>
                    <td style="border: 1px solid #000; padding: 3px;">{{ $bku->kertas_50 }} Lembar</td>
                    <td style="border: 1px solid #000; padding: 3px;">=</td>
                    <td style="border: 1px solid #000; padding: 3px;">Rp -</td>
                </tr>
                <tr>
                    <td style="border: 1px solid #000; padding: 3px;">Lembaran Uang Kertas</td>
                    <td style="border: 1px solid #000; padding: 3px;">Rp 20.000,00</td>
                    <td style="border: 1px solid #000; padding: 3px;">x</td>
                    <td style="border: 1px solid #000; padding: 3px;">{{ $bku->kertas_20 }} Lembar</td>
                    <td style="border: 1px solid #000; padding: 3px;">=</td>
                    <td style="border: 1px solid #000; padding: 3px;">Rp -</td>
                </tr>
                <tr>
                    <td style="border: 1px solid #000; padding: 3px;">Lembaran Uang Kertas</td>
                    <td style="border: 1px solid #000; padding: 3px;">Rp 10.000,00</td>
                    <td style="border: 1px solid #000; padding: 3px;">x</td>
                    <td style="border: 1px solid #000; padding: 3px;">{{ $bku->kertas_10 }} Lembar</td>
                    <td style="border: 1px solid #000; padding: 3px;">=</td>
                    <td style="border: 1px solid #000; padding: 3px;">Rp -</td>
                </tr>
                <tr>
                    <td style="border: 1px solid #000; padding: 3px;">Lembaran Uang Kertas</td>
                    <td style="border: 1px solid #000; padding: 3px;">Rp 5.000,00</td>
                    <td style="border: 1px solid #000; padding: 3px;">x</td>
                    <td style="border: 1px solid #000; padding: 3px;">{{ $bku->kertas_5 }} Lembar</td>
                    <td style="border: 1px solid #000; padding: 3px;">=</td>
                    <td style="border: 1px solid #000; padding: 3px;">Rp -</td>
                </tr>
                <tr>
                    <td style="border: 1px solid #000; padding: 3px;">Lembaran Uang Kertas</td>
                    <td style="border: 1px solid #000; padding: 3px;">Rp 1.000,00</td>
                    <td style="border: 1px solid #000; padding: 3px;">x</td>
                    <td style="border: 1px solid #000; padding: 3px;">{{ $bku->kertas_1 }} Lembar</td>
                    <td style="border: 1px solid #000; padding: 3px;">=</td>
                    <td style="border: 1px solid #000; padding: 3px;">Rp -</td>
                </tr>
                <tr>
                    <th colspan="5" style="border-left: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; border-top: 3px solid #000; padding: 3px; font-weight: bold; text-align: center;">Jumlah
                    </th>
                    <th style="border-left: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; border-top: 3px solid #000; padding: 3px; font-weight: bold; text-align: center;">Rp -</th>
                </tr>

                <tr>
                    <th colspan="6" style="text-align: center;">UANG LOGAM</th>
                </tr>
                <tr>
                    <td style="border: 1px solid #000; padding: 3px;">Uang Logam</td>
                    <td style="border: 1px solid #000; padding: 3px;">Rp 1.000,00</td>
                    <td style="border: 1px solid #000; padding: 3px;">x</td>
                    <td style="border: 1px solid #000; padding: 3px;">{{ $bku->logam_1000 }} Lembar</td>
                    <td style="border: 1px solid #000; padding: 3px;">=</td>
                    <td style="border: 1px solid #000; padding: 3px;">Rp -</td>
                </tr>
                <tr>
                    <td style="border: 1px solid #000; padding: 3px;">Uang Logam</td>
                    <td style="border: 1px solid #000; padding: 3px;">Rp 500,00</td>
                    <td style="border: 1px solid #000; padding: 3px;">x</td>
                    <td style="border: 1px solid #000; padding: 3px;">{{ $bku->logam_500 }} Lembar</td>
                    <td style="border: 1px solid #000; padding: 3px;">=</td>
                    <td style="border: 1px solid #000; padding: 3px;">Rp -</td>
                </tr>
                <tr>
                    <td style="border: 1px solid #000; padding: 3px;">Uang Logam</td>
                    <td style="border: 1px solid #000; padding: 3px;">Rp 100,00</td>
                    <td style="border: 1px solid #000; padding: 3px;">x</td>
                    <td style="border: 1px solid #000; padding: 3px;">{{ $bku->logam_100 }} Lembar</td>
                    <td style="border: 1px solid #000; padding: 3px;">=</td>
                    <td style="border: 1px solid #000; padding: 3px;">Rp -</td>
                </tr>
                <tr>
                    <td style="border: 1px solid #000; padding: 3px;">Uang Logam</td>
                    <td style="border: 1px solid #000; padding: 3px;">Rp 50,00</td>
                    <td style="border: 1px solid #000; padding: 3px;">x</td>
                    <td style="border: 1px solid #000; padding: 3px;">{{ $bku->logam_50 }} Lembar</td>
                    <td style="border: 1px solid #000; padding: 3px;">=</td>
                    <td style="border: 1px solid #000; padding: 3px;">Rp -</td>
                </tr>
                <tr>
                    <td style="border: 1px solid #000; padding: 3px;">Uang Logam</td>
                    <td style="border: 1px solid #000; padding: 3px;">Rp 25,00</td>
                    <td style="border: 1px solid #000; padding: 3px;">x</td>
                    <td style="border: 1px solid #000; padding: 3px;">{{ $bku->logam_25 }} Lembar</td>
                    <td style="border: 1px solid #000; padding: 3px;">=</td>
                    <td style="border: 1px solid #000; padding: 3px;">Rp -</td>
                </tr>
                <tr>
                    <td style="border: 1px solid #000; padding: 3px;">Uang Logam</td>
                    <td style="border: 1px solid #000; padding: 3px;">Rp 10,00</td>
                    <td style="border: 1px solid #000; padding: 3px;">x</td>
                    <td style="border: 1px solid #000; padding: 3px;">{{ $bku->logam_10 }} Lembar</td>
                    <td style="border: 1px solid #000; padding: 3px;">=</td>
                    <td style="border: 1px solid #000; padding: 3px;">Rp -</td>
                </tr>
                <tr>
                    <td style="border: 1px solid #000; padding: 3px;">Uang Logam</td>
                    <td style="border: 1px solid #000; padding: 3px;">Rp 5,00</td>
                    <td style="border: 1px solid #000; padding: 3px;">x</td>
                    <td style="border: 1px solid #000; padding: 3px;">{{ $bku->logam_5 }} Lembar</td>
                    <td style="border: 1px solid #000; padding: 3px;">=</td>
                    <td style="border: 1px solid #000; padding: 3px;">Rp -</td>
                </tr>
                <tr>
                    <th colspan="5" style="border-left: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; border-top: 3px solid #000; padding: 3px; font-weight: bold; text-align: center;">Jumlah
                    </th>
                    <th style="border-left: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; border-top: 3px solid #000; padding: 3px; font-weight: bold; text-align: center;">Rp -</th>
                </tr>
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
                            PPTK<br><br><br><br><br><br>
                            <strong style="text-decoration: underline;">{{ $bku->nama_pptk }}</strong><br>
                            <label>NIP. {{ $bku->nip_pptk }}</label>
                        </td>
                        <td class="data-value-center">
                            Bendahara Pengeluaran Pembantu<br><br><br><br><br><br>
                            <strong style="text-decoration: underline;">{{ $bku->nama_bpp }}</strong><br>
                            <label>NIP. {{ $bku->nip_bpp }}</label>
                        </td>
                        <tr>
                            <td colspan="2" class="data-value-center">
                                Mengetahui/Menyetujui<br>
                                Kuasa Pengguna Anggaran<br><br><br><br><br>
                                <strong style="text-decoration: underline;">{{ $bku->nama_kpa }}</strong><br>
                                <label>NIP. {{ $bku->nip_kpa }}</label>
                            </td>
                        </tr>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>