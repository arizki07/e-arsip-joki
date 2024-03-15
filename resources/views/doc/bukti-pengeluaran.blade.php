<!DOCTYPE html>
<html>

<head>
    <title>Bukti Pengeluaran Dinas Pamong Praja</title>
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

        .content-value-ttd {
            text-align: center;
            /* padding: 1px 2px; */
            /* style="font-size: 10pt; */

      /* text-transform: capitalize; */
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
                        <font style="font-size: 14px;">TAHUN ANGGARAN : {{ \Carbon\Carbon::now()->locale('id')->isoFormat('YYYY') }}</font>
                        <div class="tebal">
                            <font style="font-size: 14px;">TANDA BUKTI PENGELUARAN</font>
                        </div>
                        <font style="font-size: 14px;">NOMOR : {{ $data->no_bukti }}</font>
                        <!-- <div class="kontak">
                            E-mail: <font style="color: blue;">smp-2smbr@gmail.com</font> Telp: (021) 2176263 Website: <font style="color: blue;">smpn-2-smbr.sch.id</font>
                        </div> -->
                    </td>
                </tr>
            </table>
            <hr class="garis">
        </div>
        {{-- <div class="header-content">
            <h3 style="font-size: 14pt;"><strong><u>FORMULIR PERMINTAAN PEMBAYARAN UP/GU/TU</u></strong></h3>
        </div> --}}
        <div class="table-container">
            <table class="table-bawah" style="border: 0px; font-size: 12pt; width: 620px; margin: auto;">
                <tbody>
                    {{-- <tr>
                        <td class="data-value" colspan="2">Dengan ini kami ajukan permintaan UP untuk kegiatan:</td>
                    </tr> --}}
                    <tr>
                        <td class="data-value-1">Terima Dari</td>
                        <td class="data-value">: Bendahara Pengeluaran SATPOL PP Kota Cirebon</td>
                    </tr>
                    <tr>
                        <td class="data-value-1">Uang Sejumlah</td>
                        <td class="data-value">: {{ $data->td_biaya }}</td>
                    </tr>
                    <tr>
                        <td class="data-value-1">Terbilang</td>
                        <td class="data-value">: {{ $terbilangRupiah }} Rupiah</td>
                    </tr>

                    {{-- {{ \Carbon\Carbon::parse($laporanPengajuan->p_tanggal)->locale('id')->isoFormat('D MMMM YYYY') }} --}}
                    <tr>
                        <td class="data-value-1">Untuk Keperluan</td>
                    </tr>
                    <tr>
                        <td class="data-value-1">Program Anggaran</td>
                        <td class="data-value">: {{ $data->p_nama_kegiatan }}</td>
                    </tr>
                    <tr>
                        <td class="data-value-1">Sub Kegiatan</td>
                        <td class="data-value">: {{ $data->p_sub_kegiatan }}</td>
                    </tr>
                    <tr>
                        <td class="data-value-1">Bulan</td>
                        <td class="data-value">: {{ $data->p_tanggal }}</td>
                    </tr>
                </tbody>
            </table>
            <table class="tabel-data" style="font-size: 12pt; width: 620px; margin: auto; border-collapse: collapse; border: 1px solid #000;">
                <tr>
                  <td class="content-value-ttd" style="border: 1px solid #000;"> Rincian Kode Rekening</td>
                  <td class="content-value-ttd" style="border: 1px solid #000;"> Jumlah</td>
                </tr>
                <tr>
                    <td class="content-value-ttd" style="border: 1px solid #000;">
                        @foreach (json_decode($data->td_uraian) as $uraian)
{{ $uraian->uraian }} <br>
@endforeach
                    </td>
                    <td class="content-value-ttd" style="border: 1px solid #000;">
                        @foreach (json_decode($data->td_uraian) as $uraian)
{{ $uraian->jumlah }} <br>
@endforeach
                    </td>
                </tr>
                <tr>
                  <td class="content-value-ttd" style="border: 1px solid #000;">Jumlah Total</td>
                  <td class="content-value-ttd" style="border: 1px solid #000;">{{ $data->total_uraian }}</td>
                </tr>
            </table>
            <br>
            <table class="tabel-data" style="font-size: 12pt; width: 100%;">
                <tr>
                    <td></td>
                    <td></td>
                    <td style="text-align: left">Cirebon, {{ \Carbon\Carbon::now()->locale('id')->isoFormat('D MMMM YYYY') }}</td></td>
                </tr>
                <tr>
                    <td class="content-value-ttd" style="width: 33.33%;">Kuasa Pengguna Anggaran</td>
                    <td class="content-value-ttd" style="width: 33.33%;">Bendahara Pengeluaran</td>
                    <td class="content-value-ttd" style="width: 33.33%;">BPP</td>
                </tr>
                <tr>
                    <td><br><br><br><br><br></td>
                    <td><br><br><br><br><br></td>
                    <td><br><br><br><br><br></td>
                </tr>
                <tr>
                    <td class="content-value-ttd" style="width: 33.33%; text-decoration: underline;">{{ $data->nama_kpa }}</td>
                    <td class="content-value-ttd" style="width: 33.33%; text-decoration: underline;">{{ $data->nama_bpp }}</td>
                    <td class="content-value-ttd" style="width: 33.33%; text-decoration: underline;">{{ $data->nama_bpp }}</td>
                </tr>
                <tr>
                    <td class="content-value-ttd" style="width: 33.33%;">NIP. {{ $data->nip_kpa }}</td>
                    <td class="content-value-ttd" style="width: 33.33%;">NIP. </td>
                    <td class="content-value-ttd" style="width: 33.33%;">NIP. {{ $data->nip_bpp }}</td>
                </tr>
                <tr>
                    {{-- <td></td> --}}
                    <td colspan="3" class="content-value-ttd" style="width: 33.33%;">Mengetahui, <br> Kepala Satuan Polisi Pamong Praja <br> Kota Cirebon</td>
                    {{-- <td></td> --}}
                </tr>
                <tr>
                    <td></td>
                    <td><br><br><br><br><br></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td class="content-value-ttd" style="width: 33.33%; text-decoration: underline; ">{{ $data->nama_pa }}</td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td class="content-value-ttd" style="width: 33.33%;">NIP. {{ $data->nip_pa }}</td>
                    <td></td>
                </tr>
            </table>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            function terbilangIndonesia(number) {
                const huruf = ["", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan"];
                const belasan = ["", "Sebelas", "Dua Belas", "Tiga Belas", "Empat Belas", "Lima Belas",
                    "Enam Belas", "Tujuh Belas", "Delapan Belas", "Sembilan Belas"
                ];

                function terbilangSatuan(satuan) {
                    return huruf[satuan];
                }

                function terbilangPuluhan(puluhan) {
                    if (puluhan < 10) {
                        return terbilangSatuan(puluhan);
                    } else if (puluhan === 10) {
                        return "Sepuluh";
                    } else if (puluhan < 20) {
                        return belasan[puluhan - 10];
                    } else {
                        const puluhanStr = String(puluhan);
                        const satuanStr = puluhanStr[1] === "0" ? "" : " " + huruf[parseInt(puluhanStr[1])];
                        return huruf[parseInt(puluhanStr[0])] + " Puluh" + satuanStr;
                    }
                }

                function terbilangRatusan(ratusan) {
                    const ratusanStr = String(ratusan);
                    const puluhan = parseInt(ratusanStr.substring(1));
                    return huruf[parseInt(ratusanStr[0])] + " Ratus" + (puluhan > 0 ? " " + terbilangPuluhan(
                        puluhan) : "");
                }

                function terbilangRibuan(ribuan) {
                    const ribuanStr = String(ribuan);
                    const ratusan = parseInt(ribuanStr.substring(1));
                    return terbilangSatuan(parseInt(ribuanStr[0])) + " Ribu" + (ratusan > 0 ? " " +
                        terbilangRatusan(ratusan) : "");
                }

                function terbilangJutaan(jutaan) {
                    const jutaanStr = String(jutaan);
                    const ribuan = parseInt(jutaanStr.substring(1));
                    return terbilangSatuan(parseInt(jutaanStr[0])) + " Juta" + (ribuan > 0 ? " " + terbilangRibuan(
                        ribuan) : "");
                }

                const bilangan = Math.floor(number);
                const desimal = Math.round((number - bilangan) * 100);
                let terbilang = "";

                if (bilangan >= 1000000) {
                    terbilang += terbilangJutaan(Math.floor(bilangan / 1000000)) + " ";
                    bilangan %= 1000000;
                }

                if (bilangan >= 1000) {
                    terbilang += terbilangRibuan(Math.floor(bilangan / 1000)) + " ";
                    bilangan %= 1000;
                }

                if (bilangan >= 100) {
                    terbilang += terbilangRatusan(Math.floor(bilangan / 100)) + " ";
                    bilangan %= 100;
                }

                if (bilangan > 0) {
                    terbilang += terbilangPuluhan(bilangan) + " ";
                }

                if (desimal > 0) {
                    terbilang += "Koma " + terbilangPuluhan(desimal);
                }

                return terbilang.trim();
            }

            // Example usage
            const numericValue = {{ $data->td_biaya }};
            const terbilangValue = terbilangIndonesia(numericValue);
            $('#terbilang').text(terbilangValue);
        });
    </script>
</body>

</html>
