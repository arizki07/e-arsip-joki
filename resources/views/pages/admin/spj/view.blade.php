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
                    <h3>{{ $title; }}</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $title; }}</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <section class="section">
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
                                                                <td>{{$suratPengantar->kegiatan}}</td>
                                                            </tr>

                                                            <tr>
                                                                <th>No Surat</th>
                                                                <td>{{$suratPengantar->nomor_surat}}</td>
                                                            </tr>

                                                            <tr>
                                                                <th>Sifat</th>
                                                                <td>{{$suratPengantar->sifat}}</td>
                                                            </tr>

                                                            <tr>
                                                                <th>Lampiran</th>
                                                                <td>{{$suratPengantar->lampiran}}</td>
                                                            </tr>

                                                            <tr>
                                                                <th>Perihal</th>
                                                                <td>{{$suratPengantar->perihal}}</td>
                                                            </tr>

                                                            <tr>
                                                                <th>Biaya</th>
                                                                <td>Rp {{ number_format($suratPengantar->biaya, 0, ',', '.') }}</td>
                                                            </tr>
                                                            
                                                            <tr>
                                                                <th>Tanggal</th>
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
                                                                    <td>Satuan Polisi Pamong Praja</td>
                                                                </tr>

                                                                <tr>
                                                                    <th>Nama & Kode Program</th>
                                                                    <td>PROGRAM PENUNJANG URUSAN PEMERINTAHAN DAERAH KABUPATEN/KOTA</td>
                                                                </tr>

                                                                <tr>
                                                                    <th>Nama Kegiatan</th>
                                                                    <td>{{ $suratPengantar->kegiatan }}</td>
                                                                </tr>
                                                                @foreach ($buktiPengeluaran as $bukti)
                                                                    @if ($bukti->id_td_bukti == $suratPengantar->id_td_bukti)
                                                                        @foreach ($biodata as $bio)
                                                                            @if ($bio->id_biodata == $bukti->td_kpa_id)
                                                                                <tr>
                                                                                    <th>Kuasa Pengguna Anggaran</th>
                                                                                    <td>{{ $bio->nama }}</td>
                                                                                </tr>
                                                                            @endif

                                                                            @if ($bio->id_biodata == $bukti->td_pa_id)
                                                                                <tr>
                                                                                    <th>Pengguna Anggaran</th>
                                                                                    <td>{{ $bio->nama }}</td>
                                                                                </tr>
                                                                            @endif

                                                                            @if ($bio->id_biodata == $bukti->td_bpp_id)
                                                                                <tr>
                                                                                    <th>Badan Pengeluaran Pembantu</th>
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
                                                <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
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
                                                <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
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
