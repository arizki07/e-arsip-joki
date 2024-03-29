<!DOCTYPE html>
<html>

<head>
    <title>Pengajuan Nota Dinas Pamong Praja</title>
    <style type="text/css">
        body {
            font-family: 'Times New Roman', Times, serif;
        }

        /* .rangkasurat {
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
        } */

        .logo {
            width: 100px;
        }

        .tabel-content,
        .tabel-hasil,
        .content-value {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 1px 2px;
        }

        .tabel-content {
            margin-top: 10px;
        }

        .content-value-center {
            border: 1px solid black;
            border-collapse: collapse;
            text-align: center;
            padding: 1px 2px;
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
            border: 0px;
            /* Batas setiap sel */
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

        .page-break {
            page-break-after: always;
        }


        header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 3cm;
            text-align: left;
            margin-bottom: 1.2cm;
        }

        body {
            margin: 110px 15px 15px 15px;
            padding: 0;
        }
    </style>
</head>

<body>
    <header>
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
    </header>
    {{-- <div class="rangkasurat"> --}}
    <br>
    <div class="header-content">
        <h3 style="font-size: 14pt;"><strong><u>FORMULIR PERMINTAAN PEMBAYARAN UP/GU/TU</u></strong></h3>
    </div>
    <div class="table-container">
        <table class="table-bawah" style="border: 0px; font-size: 12pt; width: 620px; margin: auto;">
            <tbody>
                <tr>
                    <td class="data-value" colspan="2">Dengan ini kami ajukan permintaan UP untuk kegiatan:</td>
                </tr>
                <tr>
                    <td class="data-value-1">Nama Kegiatan</td>
                    <td class="data-value">: {{ $laporanPengajuan->p_nama_kegiatan }}</td>
                </tr>
                <tr>
                    <td class="data-value-1">Sub Kegiatan</td>
                    <td class="data-value">: {{ $laporanPengajuan->p_sub_kegiatan }}</td>
                </tr>
                <tr>
                    <td class="data-value-1">Pekerjaan Bulanan</td>
                    <td class="data-value">:
                        {{ \Carbon\Carbon::parse($laporanPengajuan->p_tanggal)->locale('id')->isoFormat('D MMMM YYYY') }}
                    </td>
                </tr>
                <tr>
                    <td class="data-value-1">Sebesar</td>
                    <td class="data-value">: {{ $laporanPengajuan->p_biaya }}</td>
                </tr>
                <tr>
                    <td class="data-value-1"></td>
                    <td class="data-value"></td>
                </tr>
                <tr>
                    <td class="data-value" colspan="2">Demikian untuk menjadi bahan selanjutanya</td>
                </tr>
                <tr>
                    <td class="data-value-1"></td>
                    <td class="data-value"></td>
                </tr>
                <tr>
                    <td class="data-value-1"></td>
                    <td style="text-align: right;">Cirebon,
                        {{ \Carbon\Carbon::now()->locale('id')->isoFormat('D MMMM YYYY') }}</td>
                </tr>
            </tbody>
        </table>
        <table style="border: 5px; font-size: 12pt; width: 620px; margin: auto;">
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
                    <strong style="text-decoration: underline;">{{ $laporanPengajuan->nama_kpa }}</strong><br>
                    <label>NIP. {{ $laporanPengajuan->nip_kpa }}</label>
                </td>
                <td class="data-value-center">
                    Bendahara Pengeluaran Pembantu<br><br><br><br><br><br>
                    <strong style="text-decoration: underline;">{{ $laporanPengajuan->nama_bpp }}</strong><br>
                    <label>NIP. {{ $laporanPengajuan->nip_bpp }}</label>
                </td>
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
                        <strong style="text-decoration: underline;">{{ $laporanPengajuan->nama_pa }}</strong><br>
                        <label>NIP. {{ $laporanPengajuan->nip_pa }}</label>
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

    <div class="page-break"></div>
    {{-- </div> --}}
    <br>
    <div class="header-content">
        <h3 style="font-size: 14pt;"><strong><u>NOTA DINAS</u></strong></h3>
    </div>
    <div class="table-container">
        <table class="table-bawah" style="border: 0px; font-size: 12pt; width: 620px; margin: auto;">
            <tbody>
                <tr>
                    <td class="data-value-1">Kepada</td>
                    <td class="data-value">: Kepala Satuan Polisi Pamong Praja</td>
                </tr>
                <tr>
                    <td class="data-value-1">Dari</td>
                    <td class="data-value">: Sekretariat</td>
                </tr>
                <tr>
                    <td class="data-value-1">Nomor Nota</td>
                    <td class="data-value">:
                        {{ $notaData->nd_nomor_nota }}
                    </td>
                </tr>
                <tr>
                    <td class="data-value-1">Perihal</td>
                    <td class="data-value">: {{ $notaData->nd_perihal }}</td>
                </tr>
            </tbody>
        </table>
        {{-- <table style="border: 5px; font-size: 12pt; width: 620px; margin: auto;">
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
                    <strong style="text-decoration: underline;">{{ $laporanPengajuan->nama_kpa }}</strong><br>
                    <label>NIP. {{ $laporanPengajuan->nip_kpa }}</label>
                </td>
                <td class="data-value-center">
                    Bendahara Pengeluaran Pembantu<br><br><br><br><br><br>
                    <strong style="text-decoration: underline;">{{ $laporanPengajuan->nama_bpp }}</strong><br>
                    <label>NIP. {{ $laporanPengajuan->nip_bpp }}</label>
                </td>
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
                        <strong style="text-decoration: underline;">{{ $laporanPengajuan->nama_pa }}</strong><br>
                        <label>NIP. {{ $laporanPengajuan->nip_pa }}</label>
                    </td>
                    <td style="text-align: center;">
                        <div style="text-align: left; display: inline-block;">
                            <strong>Catatan PA:</strong> Nilai SPJ sesuai<br>dengan permintaan pembayaran<br><br>
                            Paraf Verifikasi:<br><br><br><br><br>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table> --}}
        <table class="table-bawah" style="border: 0px; font-size: 12pt; width: 620px; margin: auto;">
            <tbody>
                <tr>
                    <td class="data-value-1" style="text-align: justify">
                        Dipermaklum dengan hormat bahwa Sekretariat telah di laksanakan Kegiatan
                        {{ $notaData->nd_nama_kegiatan }}. Sehubungan dengan
                        hal tersebut, dengan ini kami mengajukan Pencairan dana untuk Sub Kegiatan
                        {{ $notaData->nd_sub_kegiatan }}
                        dengan perincian
                        sebagai berikut :
                    </td>
                </tr>
            </tbody>
        </table>
        <br>
        {{--  TABLE URAIAN --}}
        <table class="tabel-content" style=" font-size: 12pt; width: 620px; margin: auto;">
            {{-- <tbody> --}}
            <tr>
                <td class="content-value-center">No</td>
                <td class="content-value-center">Uraian Kegiatan</td>
                <td class="content-value-center">Jumlah</td>
            </tr>
            <tr>
                <td class="content-value-center">1</td>
                <td class="content-value-center">{{ $notaData->nd_uraian_kegiatan }}</td>
                <td class="content-value-center">{{ $notaData->nd_jumlah_biaya }}</td>
            </tr>


            {{-- </tbody> --}}
        </table>
        {{--  TABLE URAIAN --}}
        <table class="table-bawah" style="border: 0px; font-size: 12pt; width: 620px; margin: auto;">
            <tbody>
                <tr>
                    <td class="data-value-1" style="text-align: justify">
                        Demikian permohonan kami, agar kiranya bapak dapat mengabulkannya. Atas perhatiannya kami
                        haturkan terima kasih.
                    </td>
                </tr>
            </tbody>
        </table>
        <br>
        <table style=" font-size: 12pt; width: 620px; margin: auto;">
            <tbody>
                <tr>
                    <td style="width: 170px"></td>
                    <td style="width: 170px"></td>
                    <td class="data-value-center">
                        Cirebon,
                        {{ \Carbon\Carbon::now()->locale('id')->isoFormat('D MMMM YYYY') }}
                    </td>
                </tr>
                <tr>
                    <td style="width: 170px"></td>
                    <td style="width: 170px"></td>
                    <td class="data-value-center">
                        Mengetahui/Menyetujui<br>
                        Kuasa Pengguna Anggaran<br><br><br><br><br>
                        <strong style="text-decoration: underline;">{{ $laporanPengajuan->nama_kpa }}</strong><br>
                        <label>NIP. {{ $laporanPengajuan->nip_kpa }}</label>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
</body>

</html>
