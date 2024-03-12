@extends('layouts.main')
@section('content')
@include('component.alerts')
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>{{ $title2; }}</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $title2; }}</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <section class="section mt-4">
                <div class="row">
                    <div class="col-12 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Data Pertangguna Jawaban</h4>
                            </div>
                            <div class="card-body">
                                <div class="accordion" id="accordionExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingOne">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            SPJ SURAT PENGANTAR
                                            </button>
                                        </h2>
                                        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>Kegiatan</th>
                                                                <td>:</td>
                                                                <td>{{$suratPengantar->kegiatan}}</td>
                                                            </tr>

                                                            <tr>
                                                                <th>No Surat</th>
                                                                <td>:</td>
                                                                <td>{{$suratPengantar->nomor_surat}}</td>
                                                            </tr>

                                                            <tr>
                                                                <th>Sifat</th>
                                                                <td>:</td>
                                                                <td>{{$suratPengantar->sifat}}</td>
                                                            </tr>

                                                            <tr>
                                                                <th>Lampiran</th>
                                                                <td>:</td>
                                                                <td>{{$suratPengantar->lampiran}}</td>
                                                            </tr>

                                                            <tr>
                                                                <th>Perihal</th>
                                                                <td>:</td>
                                                                <td>{{$suratPengantar->perihal}}</td>
                                                            </tr>

                                                            <tr>
                                                                <th>Biaya</th>
                                                                <td>:</td>
                                                                <td>Rp {{ number_format($suratPengantar->biaya, 0, ',', '.') }}</td>
                                                            </tr>
                                                            
                                                            <tr>
                                                                <th>Tanggal</th>
                                                                <td>:</td>
                                                                <td>{{ \Carbon\Carbon::parse($suratPengantar->tanggal)->format('d-m-Y') }}</td>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingTwo">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            SPJ BKU
                                            </button>
                                        </h2>
                                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <div class="table-responsive">
                                                    <div class="card-body">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Satuan Perangkat Kerja Daerah</th>
                                                                    <td>:</td>
                                                                    <td>Satuan Polisi Pamong Praja</td>
                                                                </tr>

                                                                <tr>
                                                                    <th>Nama & Kode Program</th>
                                                                    <td>:</td>
                                                                    <td>PROGRAM PENUNJANG URUSAN PEMERINTAHAN DAERAH KABUPATEN/KOTA</td>
                                                                </tr>

                                                                <tr>
                                                                    <th>Nama Kegiatan</th>
                                                                    <td>:</td>
                                                                    <td>{{ $suratPengantar->kegiatan }}</td>
                                                                </tr>
                                                                @foreach ($buktiPengeluaran as $bukti)
                                                                    @if ($bukti->id_td_bukti == $suratPengantar->id_td_bukti)
                                                                        @foreach ($biodata as $bio)
                                                                            @if ($bio->id_biodata == $bukti->td_kpa_id)
                                                                                <tr>
                                                                                    <th>Kuasa Pengguna Anggaran</th>
                                                                                    <td>:</td>
                                                                                    <td>{{ $bio->nama }}</td>
                                                                                </tr>
                                                                            @endif

                                                                            @if ($bio->id_biodata == $bukti->td_pa_id)
                                                                                <tr>
                                                                                    <th>Pengguna Anggaran</th>
                                                                                    <td>:</td>
                                                                                    <td>{{ $bio->nama }}</td>
                                                                                </tr>
                                                                            @endif

                                                                            @if ($bio->id_biodata == $bukti->td_bpp_id)
                                                                                <tr>
                                                                                    <th>Badan Pengeluaran Pembantu</th>
                                                                                    <td>:</td>
                                                                                    <td>{{ $bio->nama }}</td>
                                                                                </tr>
                                                                            @endif
                                                                        @endforeach
                                                                    @endif
                                                                @endforeach
                                                            </thead>
                                                        </table>

                                                        <div class="card-header text-center">
                                                            <h5 class="card-title">
                                                                Data Detail SPJ BKU
                                                            </h5>
                                                        </div>
                                                        <table class="table table-bordered table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th>No Urut</th>
                                                                    <th>Tanggal</th>
                                                                    <th>Uraian</th>
                                                                    <th>K.Rekening</th>
                                                                    <th>Penerimaan</th>
                                                                    <th>Pengeluaran</th>
                                                                    <th>Saldo</th>
                                                                    <th>Ket</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($uraianBku as $urBKU)
                                                                    @if ($urBKU->id_surat_pengantar == $suratPengantar->id_surat_pengantar)
                                                                        <tr>
                                                                            <td>{{ $urBKU->no_urut }}</td>
                                                                            <td>{{ \Carbon\Carbon::parse($urBKU->tanggal)->format('d M Y') }}</td>
                                                                            <td>{{ $urBKU->uraian }}</td>
                                                                            <td>{{ $urBKU->kode_rekening }}</td>
                                                                            <td>
                                                                                @if ($urBKU->penerimaan !== '-')
                                                                                    Rp {{ number_format($urBKU->penerimaan, 0, ',', '.') }}
                                                                                @else
                                                                                    {{ $urBKU->penerimaan }}
                                                                                @endif
                                                                            </td>
                                                                            <td>
                                                                                @if ($urBKU->pengeluaran !== '-')
                                                                                    Rp {{ number_format($urBKU->pengeluaran, 0, ',', '.') }}
                                                                                @else
                                                                                    {{ $urBKU->pengeluaran }}
                                                                                @endif
                                                                            </td>
                                                                            <td>
                                                                                @if ($urBKU->saldo !== '-')
                                                                                    Rp {{ number_format($urBKU->saldo, 0, ',', '.') }}
                                                                                @else
                                                                                    {{ $urBKU->saldo }}
                                                                                @endif
                                                                            </td>
                                                                            <td>{{ $urBKU->keterangan }}</td>
                                                                        </tr>
                                                                    @endif
                                                                @endforeach
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <th colspan="4" class="text-center">Jumlah</th>
                                                                    <th>Rp {{ number_format($totalPenerimaan, 0, ',', '.') }}</th>
                                                                    <th>Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</th>
                                                                    <th>Rp {{ number_format($totalSaldo, 0, ',', '.') }}</th>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingThree">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            SPJ FUNGSIONAL
                                            </button>
                                        </h2>
                                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <div class="table-responsive">
                                                    <div class="card-body">
                                                        <table class="table">
                                                            <thead>
                                                                @foreach ($fungsional as $fung)
                                                                    @if ($fung->id_surat_pengantar == $suratPengantar->id_surat_pengantar)
                                                                        <tr>
                                                                            <th>Urusan Pemerintahan</th>
                                                                            <td>:</td>
                                                                            <td>{{ $fung->urusan }}</td>
                                                                        </tr>

                                                                        <tr>
                                                                            <th>Organisasi</th>
                                                                            <td>:</td>
                                                                            <td>{{ $fung->organisasi }}</td>
                                                                        </tr>

                                                                        <tr>
                                                                            <th>Program</th>
                                                                            <td>:</td>
                                                                            <td>{{ $fung->program }}</td>
                                                                        </tr>

                                                                        <tr>
                                                                            <th>Kegiatan</th>
                                                                            <td>:</td>
                                                                            <td>{{ $fung->kegiatan }}</td>
                                                                        </tr>
                                                                    @endif
                                                                @endforeach
                                                            </thead>
                                                        </table>

                                                        
                                                        <div class="card-header text-center">
                                                            <h5 class="card-title">
                                                                Data Detail SPJ FUNGSIONAL
                                                            </h5>
                                                        </div>
                                                        <table class="table table-bordered table-striped">
                                                            <thead class="table">
                                                                <tr class="text-center">
                                                                    <th>Kode Rekening</th>
                                                                    <th>Uraian</th>
                                                                    <th>Jumlah Anggaran</th>
                                                                    <th>s.d Bulan Lalu</th>
                                                                    <th>Bulan Ini</th>
                                                                    <th>s.d Bulan Ini</th>
                                                                    <th>Jumlah SPJ (LS + UP/GU/TU s.d Bulan Ini)</th>
                                                                    <th>Sisa Pagu Anggaran</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($uraianFungsional as $urFUNG)
                                                                    @if ($urFUNG->id_surat_pengantar == $suratPengantar->id_surat_pengantar)
                                                                        @if ($urFUNG->tipe == 'Uraian Fungsional')
                                                                            <tr>
                                                                                <td>{{ $urFUNG->kode_rekening }}</td>
                                                                                <td>{{ $urFUNG->uraian }}</td>
                                                                                <td>
                                                                                    @if ($urFUNG->jumlah_anggaran !== '-')
                                                                                        Rp {{ number_format($urFUNG->jumlah_anggaran, 0, ',', '.') }}
                                                                                    @else
                                                                                        {{ $urFUNG->jumlah_anggaran }}
                                                                                    @endif
                                                                                </td>
                                                                                <td>
                                                                                    @if ($urFUNG->sd_bulan_lalu !== '-')
                                                                                        Rp {{ number_format($urFUNG->sd_bulan_lalu, 0, ',', '.') }}
                                                                                    @else
                                                                                        {{ $urFUNG->sd_bulan_lalu }}
                                                                                    @endif
                                                                                </td>
                                                                                <td>
                                                                                    @if ($urFUNG->bulan_ini !== '-')
                                                                                        Rp {{ number_format($urFUNG->bulan_ini, 0, ',', '.') }}
                                                                                    @else
                                                                                        {{ $urFUNG->bulan_ini }}
                                                                                    @endif
                                                                                </td>
                                                                                <td>
                                                                                    @if ($urFUNG->sd_bulan_ini !== '-')
                                                                                        Rp {{ number_format($urFUNG->sd_bulan_ini, 0, ',', '.') }}
                                                                                    @else
                                                                                        {{ $urFUNG->sd_bulan_ini }}
                                                                                    @endif
                                                                                </td>
                                                                                <td>
                                                                                    @if ($urFUNG->jumlah_spj !== '-')
                                                                                        Rp {{ number_format($urFUNG->jumlah_spj, 0, ',', '.') }}
                                                                                    @else
                                                                                        {{ $urFUNG->jumlah_spj }}
                                                                                    @endif
                                                                                </td>
                                                                                <td>
                                                                                    @if ($urFUNG->sisa_pagu_anggaran !== '-')
                                                                                        Rp {{ number_format($urFUNG->sisa_pagu_anggaran, 0, ',', '.') }}
                                                                                    @else
                                                                                        {{ $urFUNG->sisa_pagu_anggaran }}
                                                                                    @endif
                                                                                </td>
                                                                            </tr>
                                                                        @endif
                                                                    @endif
                                                                @endforeach
                                                                <tr>
                                                                    <th colspan="2" class="text-center">Jumlah</th>
                                                                    <th>Rp {{ number_format($jmlAnggaran, 0, ',', '.') }}</th>
                                                                    <th>
                                                                        @if ($jmlBulanLalu !== '-')
                                                                            Rp {{ number_format($jmlBulanLalu, 0, ',', '.') }}
                                                                        @else
                                                                            {{ $jmlBulanLalu }}
                                                                        @endif
                                                                    </th>
                                                                    <th>Rp {{ number_format($jmlBulanIni, 0, ',', '.') }}</th>
                                                                    <th>Rp {{ number_format($jmlsdBulanIni, 0, ',', '.') }}</th>
                                                                    <th>Rp {{ number_format($jumlahSpjTerbesar, 0, ',', '.') }}</th>
                                                                    <th>Rp {{ number_format($jmlAnggaran - $jumlahSpjTerbesar, 0, ',', '.') }}</th>
                                                                </tr>

                                                                <tr>
                                                                    <th colspan="8"># PENERIMAAN</th>
                                                                </tr>
                                                                @php
                                                                    $i = 1;
                                                                @endphp
                                                                @foreach ($uraianFungsional as $urFUNG)
                                                                    @if ($urFUNG->id_surat_pengantar == $suratPengantar->id_surat_pengantar)
                                                                        @if ($urFUNG->tipe == 'Penerimaan')
                                                                            <tr>
                                                                                <td class="text-center">{{ $i++;}}</td>
                                                                                <td colspan="2">{{ $urFUNG->uraian }}</td>
                                                                                <td>
                                                                                    @if ($urFUNG->sd_bulan_lalu !== '-')
                                                                                        Rp {{ number_format($urFUNG->sd_bulan_lalu, 0, ',', '.') }}
                                                                                    @else
                                                                                        {{ $urFUNG->sd_bulan_lalu }}
                                                                                    @endif
                                                                                </td>
                                                                                <td>
                                                                                    @if ($urFUNG->bulan_ini !== '-')
                                                                                        Rp {{ number_format($urFUNG->bulan_ini, 0, ',', '.') }}
                                                                                    @else
                                                                                        {{ $urFUNG->bulan_ini }}
                                                                                    @endif
                                                                                </td>
                                                                                <td>
                                                                                    @if ($urFUNG->sd_bulan_ini !== '-')
                                                                                        Rp {{ number_format($urFUNG->sd_bulan_ini, 0, ',', '.') }}
                                                                                    @else
                                                                                        {{ $urFUNG->sd_bulan_ini }}
                                                                                    @endif
                                                                                </td>
                                                                                <td>
                                                                                    @if ($urFUNG->jumlah_spj !== '-')
                                                                                        Rp {{ number_format($urFUNG->jumlah_spj, 0, ',', '.') }}
                                                                                    @else
                                                                                        {{ $urFUNG->jumlah_spj }}
                                                                                    @endif
                                                                                </td>
                                                                                <td>
                                                                                    @if ($urFUNG->sisa_pagu_anggaran !== '-')
                                                                                        Rp {{ number_format($urFUNG->sisa_pagu_anggaran, 0, ',', '.') }}
                                                                                    @else
                                                                                        {{ $urFUNG->sisa_pagu_anggaran }}
                                                                                    @endif
                                                                                </td>
                                                                            </tr>
                                                                        @endif
                                                                    @endif
                                                                @endforeach

                                                                <tr>
                                                                    <th colspan="3" class="text-center">Jumlah Penerimaan</th>
                                                                    <th>Rp 0</th>
                                                                    <th>
                                                                        @if ($totalPenerimaan !== '-')
                                                                            Rp {{ number_format($totalPenerimaan, 0, ',', '.') }}
                                                                        @else
                                                                            {{ $totalPenerimaan }}
                                                                        @endif
                                                                    </th>
                                                                    <th>
                                                                        @if ($totalPenerimaansd !== '-')
                                                                            Rp {{ number_format($totalPenerimaansd, 0, ',', '.') }}
                                                                        @else
                                                                            {{ $totalPenerimaansd }}
                                                                        @endif
                                                                    </th>
                                                                    <th>
                                                                        @if ($totalPenerimaansd !== '-')
                                                                            Rp {{ number_format($totalPenerimaansd, 0, ',', '.') }}
                                                                        @else
                                                                            {{ $totalPenerimaansd }}
                                                                        @endif
                                                                    </th>
                                                                    <th>Rp 0</th>
                                                                </tr>

                                                                <tr>
                                                                    <th colspan="8"># PENGELUARAN</th>
                                                                </tr>
                                                                @php
                                                                    $j = 1;
                                                                @endphp
                                                                @foreach ($uraianFungsional as $urFUNG)
                                                                @if ($urFUNG->id_surat_pengantar == $suratPengantar->id_surat_pengantar)
                                                                    @if ($urFUNG->tipe == 'Pengeluaran')
                                                                        <tr>
                                                                            <td class="text-center">{{ $j++; }}</td>
                                                                            <td colspan="2">{{ $urFUNG->uraian }}</td>
                                                                            <td>
                                                                                @if ($urFUNG->sd_bulan_lalu !== '-')
                                                                                    Rp {{ number_format($urFUNG->sd_bulan_lalu, 0, ',', '.') }}
                                                                                @else
                                                                                    {{ $urFUNG->sd_bulan_lalu }}
                                                                                @endif
                                                                            </td>
                                                                            <td>
                                                                                @if ($urFUNG->bulan_ini !== '-')
                                                                                    Rp {{ number_format($urFUNG->bulan_ini, 0, ',', '.') }}
                                                                                @else
                                                                                    {{ $urFUNG->bulan_ini }}
                                                                                @endif
                                                                            </td>
                                                                            <td>
                                                                                @if ($urFUNG->sd_bulan_ini !== '-')
                                                                                    Rp {{ number_format($urFUNG->sd_bulan_ini, 0, ',', '.') }}
                                                                                @else
                                                                                    {{ $urFUNG->sd_bulan_ini }}
                                                                                @endif
                                                                            </td>
                                                                            <td>
                                                                                @if ($urFUNG->jumlah_spj !== '-')
                                                                                    Rp {{ number_format($urFUNG->jumlah_spj, 0, ',', '.') }}
                                                                                @else
                                                                                    {{ $urFUNG->jumlah_spj }}
                                                                                @endif
                                                                            </td>
                                                                            <td>
                                                                                @if ($urFUNG->sisa_pagu_anggaran !== '-')
                                                                                    Rp {{ number_format($urFUNG->sisa_pagu_anggaran, 0, ',', '.') }}
                                                                                @else
                                                                                    {{ $urFUNG->sisa_pagu_anggaran }}
                                                                                @endif
                                                                            </td>
                                                                        </tr>
                                                                    @endif
                                                                @endif
                                                            @endforeach

                                                            <tr>
                                                                <th colspan="3" class="text-center">Jumlah Pengeluaran</th>
                                                                <th>Rp 0</th>
                                                                <th>
                                                                    @if ($totalPengeluaran !== '-')
                                                                        Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}
                                                                    @else
                                                                        {{ $totalPengeluaran }}
                                                                    @endif
                                                                </th>
                                                                <th>
                                                                    @if ($totalPengeluaransd !== '-')
                                                                        Rp {{ number_format($totalPengeluaransd, 0, ',', '.') }}
                                                                    @else
                                                                        {{ $totalPengeluaransd }}
                                                                    @endif
                                                                </th>
                                                                <th>
                                                                    @if ($totalPengeluaransd !== '-')
                                                                        Rp {{ number_format($totalPengeluaransd, 0, ',', '.') }}
                                                                    @else
                                                                        {{ $totalPengeluaransd }}
                                                                    @endif
                                                                </th>
                                                                <th>Rp 0</th>
                                                            </tr>

                                                            <tr>
                                                                <th colspan="7" class="text-center">Saldo Kas</th>
                                                                <th>RP -;</th>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingFour">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                            SPJ REGISTER KAS
                                            </button>
                                        </h2>
                                        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">

                                            <div class="accordion-body">
                                                <div class="table-responsive">
                                                    <div class="card-body">

                                                        <table class="table">
                                                            <thead>
                                                                @foreach ($register as $urREG)
                                                                    @if ($urREG->id_surat_pengantar == $suratPengantar->id_surat_pengantar)
                                                                        <tr>
                                                                            <th>Tanggal Penutupan</th>
                                                                            <td>:</td>
                                                                            <td>{{ $urREG->tgl_penutupan_lalu }}</td>
                                                                        </tr>
                                                                        @foreach ($biodata as $biodat)
                                                                            @if ($biodat->id_biodata == $urREG->id_biodata)
                                                                                <tr>
                                                                                    <th>Nama Penutup Kas</th>
                                                                                    <td>:</td>
                                                                                    <td>{{ $biodat->nama }}</td>
                                                                                </tr>
                                                                            @endif
                                                                        @endforeach

                                                                        <tr>
                                                                            <th>Jumlah Seluruh Penerimaan</th>
                                                                            <td>:</td>
                                                                            <td>
                                                                                @if ($totalPenerimaansd !== '-')
                                                                                    Rp {{ number_format($totalPenerimaansd, 0, ',', '.') }}
                                                                                @else
                                                                                    {{ $totalPenerimaansd }}
                                                                                @endif
                                                                            </td>
                                                                        </tr>

                                                                        <tr>
                                                                            <th>Jumlah Seluruh Pengeluaran</th>
                                                                            <td>:</td>
                                                                            <td>
                                                                                @if ($totalPengeluaransd !== '-')
                                                                                    Rp {{ number_format($totalPengeluaransd, 0, ',', '.') }}
                                                                                @else
                                                                                    {{ $totalPengeluaransd }}
                                                                                @endif
                                                                            </td>
                                                                        </tr>

                                                                        <tr>
                                                                            <th>Saldo Buku</th>
                                                                            <td>:</td>
                                                                            <td>
                                                                                @if ($urREG->saldo_buku !== '-')
                                                                                    Rp {{ number_format($urREG->saldo_buku, 0, ',', '.') }}
                                                                                @else
                                                                                    {{ $urREG->saldo_buku }}
                                                                                @endif
                                                                            </td>
                                                                        </tr>

                                                                        <tr>
                                                                            <th>Saldo Kas</th>
                                                                            <td>:</td>
                                                                            <td>
                                                                                @if ($urREG->saldo_kas !== '-')
                                                                                    Rp {{ number_format($urREG->saldo_kas, 0, ',', '.') }}
                                                                                @else
                                                                                    {{ $urREG->saldo_kas }}
                                                                                @endif
                                                                            </td>
                                                                        </tr>

                                                                        <tr>
                                                                            <th>Perbedaan Positif Negatif</th>
                                                                            <td>:</td>
                                                                            <td>
                                                                                @if ($urREG->positif_negatif !== '-')
                                                                                    Rp {{ number_format($urREG->positif_negatif, 0, ',', '.') }}
                                                                                @else
                                                                                    {{ $urREG->positif_negatif }}
                                                                                @endif
                                                                            </td>
                                                                        </tr>

                                                                        <tr>
                                                                            <th>Kertas Berharga</th>
                                                                            <td>:</td>
                                                                            <td>{{ $urREG->kertas_berharga }}</td>
                                                                        </tr>

                                                                        <tr>
                                                                            <th>Penjelasan Perbedaan</th>
                                                                            <td>:</td>
                                                                            <td>{{ $urREG->perbedaan }}</td>
                                                                        </tr>
                                                                    @endif
                                                                @endforeach
                                                            </thead>
                                                        </table>

                                                        <div class="card-header text-center">
                                                            <h5 class="card-title">
                                                                Data Detail SPJ REGISTER KAS
                                                            </h5>
                                                        </div>
                                                        <table class="table table-bordered table-striped">
                                                            <tbody>
                                                                <tr>
                                                                    <th colspan="6" class="text-center">UANG KERTAS</th>
                                                                </tr>
                                                                @foreach ($uraianRegister as $urREGIS)
                                                                    @if ($suratPengantar->id_surat_pengantar == $urREGIS->id_surat_pengantar)
                                                                        <tr>
                                                                            <td>Lembaran Uang Kertas</td>
                                                                            <td>Rp 100.000,00</td>
                                                                            <td>x</td>
                                                                            <td>{{ $urREGIS->kertas_100 }} Lembar</td>
                                                                            <td>=</td>
                                                                            <td>Rp -</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Lembaran Uang Kertas</td>
                                                                            <td>Rp 50.000,00</td>
                                                                            <td>x</td>
                                                                            <td>{{ $urREGIS->kertas_50 }} Lembar</td>
                                                                            <td>=</td>
                                                                            <td>Rp -</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Lembaran Uang Kertas</td>
                                                                            <td>Rp 20.000,00</td>
                                                                            <td>x</td>
                                                                            <td>{{ $urREGIS->kertas_20 }} Lembar</td>
                                                                            <td>=</td>
                                                                            <td>Rp -</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Lembaran Uang Kertas</td>
                                                                            <td>Rp 10.000,00</td>
                                                                            <td>x</td>
                                                                            <td>{{ $urREGIS->kertas_10 }} Lembar</td>
                                                                            <td>=</td>
                                                                            <td>Rp -</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Lembaran Uang Kertas</td>
                                                                            <td>Rp 5.000,00</td>
                                                                            <td>x</td>
                                                                            <td>{{ $urREGIS->kertas_5 }} Lembar</td>
                                                                            <td>=</td>
                                                                            <td>Rp -</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Lembaran Uang Kertas</td>
                                                                            <td>Rp 1.000,00</td>
                                                                            <td>x</td>
                                                                            <td>{{ $urREGIS->kertas_1 }} Lembar</td>
                                                                            <td>=</td>
                                                                            <td>Rp -</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th colspan="5" class="text-center">Jumlah</th>
                                                                            <th>Rp -</th>
                                                                        </tr>
                                                                    @endif
                                                                @endforeach

                                                                <tr>
                                                                    <th colspan="6" class="text-center">UANG LOGAM</th>
                                                                </tr>
                                                                @foreach ($uraianRegister as $urREGIS)
                                                                    @if ($suratPengantar->id_surat_pengantar == $urREGIS->id_surat_pengantar)
                                                                        <tr>
                                                                            <td>Uang Logam</td>
                                                                            <td>Rp 1.000,00</td>
                                                                            <td>x</td>
                                                                            <td>{{ $urREGIS->logam_1000 }} Lembar</td>
                                                                            <td>=</td>
                                                                            <td>Rp -</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Uang Logam</td>
                                                                            <td>Rp 500,00</td>
                                                                            <td>x</td>
                                                                            <td>{{ $urREGIS->logam_500 }} Lembar</td>
                                                                            <td>=</td>
                                                                            <td>Rp -</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Uang Logam</td>
                                                                            <td>Rp 100,00</td>
                                                                            <td>x</td>
                                                                            <td>{{ $urREGIS->logam_100 }} Lembar</td>
                                                                            <td>=</td>
                                                                            <td>Rp -</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Uang Logam</td>
                                                                            <td>Rp 50,00</td>
                                                                            <td>x</td>
                                                                            <td>{{ $urREGIS->logam_50 }} Lembar</td>
                                                                            <td>=</td>
                                                                            <td>Rp -</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Uang Logam</td>
                                                                            <td>Rp 25,00</td>
                                                                            <td>x</td>
                                                                            <td>{{ $urREGIS->logam_25 }} Lembar</td>
                                                                            <td>=</td>
                                                                            <td>Rp -</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Uang Logam</td>
                                                                            <td>Rp 10,00</td>
                                                                            <td>x</td>
                                                                            <td>{{ $urREGIS->logam_10 }} Lembar</td>
                                                                            <td>=</td>
                                                                            <td>Rp -</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Uang Logam</td>
                                                                            <td>Rp 5,00</td>
                                                                            <td>x</td>
                                                                            <td>{{ $urREGIS->logam_5 }} Lembar</td>
                                                                            <td>=</td>
                                                                            <td>Rp -</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th colspan="5" class="text-center">Jumlah</th>
                                                                            <th>Rp -</th>
                                                                        </tr>
                                                                    @endif
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>
@endsection
