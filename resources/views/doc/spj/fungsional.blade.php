<!DOCTYPE html>
<html>

<head>
    <title>SPJ Fungsional</title>
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
                        <div class="tebal" style="font-size: 18px;">LAPORAN PERTANGGUNGJAWABAN BENDAHARA PENGELUARAN PEMBANTU</div>
                        <div class="tebal" style="font-size: 18px;">(SPJ BELANJA - FUNGSIONAL)</div>
                    </td>
                </tr>
            </table>
            <hr class="garis">
        </div>

        <div class="table-container">
            <table class="table-bawah" style="border: 2px; font-size: 10pt; width: 685px; margin: auto;">
                <tbody>
                    <tr>
                        <td style="width: 170px;">Urusan Pemerintahan</td>
                        <td style="width: 5px; padding: 3px;">:</td>
                        <td class="data-value">{{ $fungsi->urusan }}</td>
                    </tr>
                    <tr>
                        <td>Organisasi</td>
                        <td style="width: 5px; padding: 3px;">:</td>
                        <td class="data-value">{{ $fungsi->organisasi }}</td>
                    </tr>
                    <tr>
                        <td>Program</td>
                        <td style="width: 5px; padding: 3px;">:</td>
                        <td class="data-value">{{ $fungsi->program }}</td>
                    </tr>
                    <tr>
                        <td>Kegiatan</td>
                        <td style="width: 5px; padding: 3px;">:</td>
                        <td class="data-value">{{ $fungsi->kegiatan }}</td>
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
                    <tr>
                        <td>Bulan</td>
                        <td style="width: 5px; padding: 3px;">:</td>
                        <td class="data-value">{{ $fungsi->bulan }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div>
            <table class="table-bawah" style="font-size: 10pt; width: 670px; margin: auto; margin-top: 10px;">
                <thead>
                    <tr>
                        <th>Kode Rekening</th>
                        <th>Uraian</th>
                        <th>Jumlah Anggaran</th>
                        <th>s.d Bulan Lalu</th>
                        <th>Bulan Ini</th>
                        <th>s.d Bulan Ini</th>
                        <th>Jumlah SPJ (LS + UP/GU/TU s.d Bulan Ini)</th>
                        <th>Sisa Pagu Anggaran</th>
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
                    @foreach ($urFungsional as $urfung)
                        @if ($urfung->tipe == 'Uraian Fungsional')
                        <tr>
                            <td style="border: 1px solid #000; padding: 3px;">{{ $urfung->kode_rekening }}</td>
                            <td style="border: 1px solid #000; padding: 3px;">{{ $urfung->uraian }}</td>
                            <td style="border: 1px solid #000; padding: 3px;">
                                @if ($urfung->jumlah_anggaran !== '-')
                                    {{ number_format($urfung->jumlah_anggaran, 0, ',', '.') }}
                                @else
                                    {{ $urfung->jumlah_anggaran }}
                                @endif
                            </td>
                            <td style="border: 1px solid #000; padding: 3px;">
                                @if ($urfung->sd_bulan_lalu !== '-')
                                    {{ number_format($urfung->sd_bulan_lalu, 0, ',', '.') }}
                                @else
                                    {{ $urfung->sd_bulan_lalu }}
                                @endif
                            </td>
                            <td style="border: 1px solid #000; padding: 3px;">
                                @if ($urfung->bulan_ini !== '-')
                                    {{ number_format($urfung->bulan_ini, 0, ',', '.') }}
                                @else
                                    {{ $urfung->bulan_ini }}
                                @endif
                            </td>
                            <td style="border: 1px solid #000; padding: 3px;">
                                @if ($urfung->sd_bulan_ini !== '-')
                                    {{ number_format($urfung->sd_bulan_ini, 0, ',', '.') }}
                                @else
                                    {{ $urfung->sd_bulan_ini }}
                                @endif
                            </td>
                            <td style="border: 1px solid #000; padding: 3px;">
                                @if ($urfung->jumlah_spj !== '-')
                                    {{ number_format($urfung->jumlah_spj, 0, ',', '.') }}
                                @else
                                    {{ $urfung->jumlah_spj }}
                                @endif
                            </td>
                            <td style="border: 1px solid #000; padding: 3px;">
                                @if ($urfung->sisa_pagu_anggaran !== '-')
                                    {{ number_format($urfung->sisa_pagu_anggaran, 0, ',', '.') }}
                                @else
                                    {{ $urfung->sisa_pagu_anggaran }}
                                @endif
                            </td>
                        </tr>
                        @endif
                    @endforeach
                    <tr>
                        <td colspan="2" style="border-left: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; border-top: 3px solid #000; padding: 3px; font-weight: bold; text-align: center;">Jumlah</td>
                        <td style="border-left: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; border-top: 3px solid #000; padding: 3px; font-weight: bold; text-align: center;">{{ number_format($jmlAnggaran, 0, ',', '.') }}</td>
                        <td style="border-left: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; border-top: 3px solid #000; padding: 3px; font-weight: bold; text-align: center;">
                            @if ($jmlBulanLalu !== '-')
                                {{ number_format($jmlBulanLalu, 0, ',', '.') }}
                            @else
                                {{ $jmlBulanLalu }}
                            @endif
                        </td>
                        <td style="border-left: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; border-top: 3px solid #000; padding: 3px; font-weight: bold; text-align: center;">{{ number_format($jmlBulanIni, 0, ',', '.') }}</td>
                        <td style="border-left: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; border-top: 3px solid #000; padding: 3px; font-weight: bold; text-align: center;">{{ number_format($jmlsdBulanIni, 0, ',', '.') }}</td>
                        <td style="border-left: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; border-top: 3px solid #000; padding: 3px; font-weight: bold; text-align: center;">{{ number_format($jumlahSpjTerbesar, 0, ',', '.') }}</td>
                        <td style="border-left: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; border-top: 3px solid #000; padding: 3px; font-weight: bold; text-align: center;">{{ number_format($jmlAnggaran - $jumlahSpjTerbesar, 0, ',', '.') }}</td>
                    </tr>

                    <tr>
                        <th colspan="8"># PENERIMAAN</th>
                    </tr>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($urFungsional as $urFUNG)
                        @if ($urFUNG->tipe == 'Penerimaan')
                        <tr>
                            <td style="border: 1px solid #000; padding: 3px; text-align: center;">{{ $i++ }}</td>
                            <td colspan="2" style="border: 1px solid #000; padding: 3px;">{{ $urFUNG->uraian }}</td>
                            <td style="border: 1px solid #000; padding: 3px;">
                                @if ($urFUNG->sd_bulan_lalu !== '-')
                                    {{ number_format($urFUNG->sd_bulan_lalu, 0, ',', '.') }}
                                @else
                                    {{ $urFUNG->sd_bulan_lalu }}
                                @endif
                            </td>
                            <td style="border: 1px solid #000; padding: 3px;">
                                @if ($urFUNG->bulan_ini !== '-')
                                    {{ number_format($urFUNG->bulan_ini, 0, ',', '.') }}
                                @else
                                    {{ $urFUNG->bulan_ini }}
                                @endif
                            </td>
                            <td style="border: 1px solid #000; padding: 3px;">
                                @if ($urFUNG->sd_bulan_ini !== '-')
                                    {{ number_format($urFUNG->sd_bulan_ini, 0, ',', '.') }}
                                @else
                                    {{ $urFUNG->sd_bulan_ini }}
                                @endif
                            </td>
                            <td style="border: 1px solid #000; padding: 3px;">
                                @if ($urFUNG->jumlah_spj !== '-')
                                    {{ number_format($urFUNG->jumlah_spj, 0, ',', '.') }}
                                @else
                                    {{ $urFUNG->jumlah_spj }}
                                @endif
                            </td>
                            <td style="border: 1px solid #000; padding: 3px;">
                                @if ($urFUNG->sisa_pagu_anggaran !== '-')
                                    {{ number_format($urFUNG->sisa_pagu_anggaran, 0, ',', '.') }}
                                @else
                                    {{ $urFUNG->sisa_pagu_anggaran }}
                                @endif
                            </td>
                        </tr>
                        @endif
                    @endforeach
                    <tr>
                        <td colspan="3" style="border-left: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; border-top: 3px solid #000; padding: 3px; font-weight: bold; text-align: center;">Jumlah Penerimaan</td>
                        <td style="border-left: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; border-top: 3px solid #000; padding: 3px; font-weight: bold; text-align: center;">-</td>
                        <td style="border-left: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; border-top: 3px solid #000; padding: 3px; font-weight: bold; text-align: center;">
                            @if ($totalPenerimaan !== '-')
                                {{ number_format($totalPenerimaan, 0, ',', '.') }}
                            @else
                                {{ $totalPenerimaan }}
                            @endif
                        </td>
                        <td style="border-left: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; border-top: 3px solid #000; padding: 3px; font-weight: bold; text-align: center;">
                            @if ($totalPenerimaansd !== '-')
                                {{ number_format($totalPenerimaansd, 0, ',', '.') }}
                            @else
                                {{ $totalPenerimaansd }}
                            @endif
                        </td>
                        <td style="border-left: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; border-top: 3px solid #000; padding: 3px; font-weight: bold; text-align: center;">
                            @if ($totalPenerimaansd !== '-')
                                {{ number_format($totalPenerimaansd, 0, ',', '.') }}
                            @else
                                {{ $totalPenerimaansd }}
                            @endif
                        </td>
                        <td style="border-left: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; border-top: 3px solid #000; padding: 3px; font-weight: bold; text-align: center;">-</td>
                    </tr>

                    <tr>
                        <th colspan="8"># PENGELUARAN</th>
                    </tr>
                    @php
                        $j = 1;
                    @endphp
                    @foreach ($urFungsional as $urFUNGSIO)
                        @if ($urFUNGSIO->tipe == 'Penerimaan')
                            <tr>
                                <td style="border: 1px solid #000; padding: 3px; text-align: center;">{{ $j++ }}</td>
                                <td style="border: 1px solid #000; padding: 3px;" colspan="2">{{ $urFUNGSIO->uraian }}</td>
                                <td style="border: 1px solid #000; padding: 3px;">
                                    @if ($urFUNGSIO->sd_bulan_lalu !== '-')
                                        {{ number_format($urFUNGSIO->sd_bulan_lalu, 0, ',', '.') }}
                                    @else
                                        {{ $urFUNGSIO->sd_bulan_lalu }}
                                    @endif
                                </td>
                                <td style="border: 1px solid #000; padding: 3px;">
                                    @if ($urFUNGSIO->bulan_ini !== '-')
                                        {{ number_format($urFUNGSIO->bulan_ini, 0, ',', '.') }}
                                    @else
                                        {{ $urFUNGSIO->bulan_ini }}
                                    @endif
                                </td>
                                <td style="border: 1px solid #000; padding: 3px;">
                                    @if ($urFUNGSIO->sd_bulan_ini !== '-')
                                        {{ number_format($urFUNGSIO->sd_bulan_ini, 0, ',', '.') }}
                                    @else
                                        {{ $urFUNGSIO->sd_bulan_ini }}
                                    @endif
                                </td>
                                <td style="border: 1px solid #000; padding: 3px;">
                                    @if ($urFUNGSIO->jumlah_spj !== '-')
                                        {{ number_format($urFUNGSIO->jumlah_spj, 0, ',', '.') }}
                                    @else
                                        {{ $urFUNGSIO->jumlah_spj }}
                                    @endif
                                </td>
                                <td style="border: 1px solid #000; padding: 3px;">
                                    @if ($urFUNGSIO->sisa_pagu_anggaran !== '-')
                                        {{ number_format($urFUNGSIO->sisa_pagu_anggaran, 0, ',', '.') }}
                                    @else
                                        {{ $urFUNGSIO->sisa_pagu_anggaran }}
                                    @endif
                                </td>
                            </tr>
                        @endif
                    @endforeach

                    <tr>
                        <td colspan="3" style="border-left: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; border-top: 3px solid #000; padding: 3px; font-weight: bold; text-align: center;">Jumlah Pengeluaran</td>
                        <td style="border-left: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; border-top: 3px solid #000; padding: 3px; font-weight: bold; text-align: center;">-</td>
                        <td style="border-left: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; border-top: 3px solid #000; padding: 3px; font-weight: bold; text-align: center;">
                            @if ($totalPengeluaran !== '-')
                                {{ number_format($totalPengeluaran, 0, ',', '.') }}
                            @else
                                {{ $totalPengeluaran }}
                            @endif
                        </td>
                        <td style="border-left: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; border-top: 3px solid #000; padding: 3px; font-weight: bold; text-align: center;">
                            @if ($totalPengeluaransd !== '-')
                                {{ number_format($totalPengeluaransd, 0, ',', '.') }}
                            @else
                                {{ $totalPengeluaransd }}
                            @endif
                        </td>
                        <td style="border-left: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; border-top: 3px solid #000; padding: 3px; font-weight: bold; text-align: center;">
                            @if ($totalPengeluaransd !== '-')
                                {{ number_format($totalPengeluaransd, 0, ',', '.') }}
                            @else
                                {{ $totalPengeluaransd }}
                            @endif
                        </td>
                        <td style="border-left: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; border-top: 3px solid #000; padding: 3px; font-weight: bold; text-align: center;">-</td>
                    </tr>

                    <tr>
                        <td style="border-left: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; border-top: 3px solid #000; padding: 3px; font-weight: bold; text-align: center;" colspan="7">Saldo Kas</td>
                        <td style="border-left: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; border-top: 3px solid #000; padding: 3px; font-weight: bold; text-align: center;">-</td>
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
                            PPTK<br><br><br><br><br><br>
                            <strong style="text-decoration: underline;">{{ $bku->nama_pptk }}</strong><br>
                            <label>NIP. {{ $bku->nip_pptk }}</label>
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