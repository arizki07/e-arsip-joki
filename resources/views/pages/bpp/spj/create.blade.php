@extends('layouts.main')
@section('content')
    @include('component.alerts')

    <div class="col-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>{{ $title }}</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h4 class="card-title">Pilih Bukti Pengeluaran Yang Sudah Disetujui</h4>
                </div>
            </div>

        </div>
    </div>

    {{-- <section class="section" style="display: none;"> --}}
    <section class="section">
        <div class="card">
            <div class="card-header text-center">
                <h3 class="card-title"> -- Surat Pengantar -- </h3>
            </div>

            <div class="card-body">
                <div id="pengajuanDetails">
                    <form action="#" method="post">

                        <div class="row">
                            <div class="form-group col-lg-4 col-md-12">
                                <label for="basicInput">Nomor Surat</label>
                                <input type="text" class="form-control mt-1" name="td_nama_kegiatan"
                                    id="nd_nama_kegiatan" placeholder="Nama Kegiatan" readonly>
                            </div>

                            <div class="form-group col-lg-4 col-md-12">
                                <label for="basicInput">Sifat</label>
                                <select class="form-select mt-1" name="" id="">
                                    <option value="">Penting</option>
                                    <option value="">Gatau</option>
                                </select>
                            </div>

                            <div class="form-group col-lg-4 col-md-12">
                                <label for="basicInput">Jumlah Lampiran</label>
                                <input type="text" class="form-control mt-1" name="td_nama_kegiatan"
                                    id="nd_nama_kegiatan" placeholder="Nama Kegiatan" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-lg-4 col-md-12">
                                <label for="basicInput">Perihal</label>
                                <input type="text" class="form-control mt-1" name="td_nama_kegiatan"
                                    id="nd_nama_kegiatan" placeholder="Nama Kegiatan" readonly>
                            </div>

                            <div class="form-group col-lg-4 col-md-12">
                                <label for="basicInput">Tgl Surat Pengantar</label>
                                <input type="text" class="form-control mt-1" name="td_nama_kegiatan"
                                    id="nd_nama_kegiatan" placeholder="Nama Kegiatan" readonly>
                            </div>

                            <div class="form-group col-lg-4 col-md-12">
                                <label for="basicInput">Pengeluaran</label>
                                <input type="text" class="form-control mt-1" name="td_nama_kegiatan"
                                    id="nd_nama_kegiatan" placeholder="Nama Kegiatan" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="basicInput">Terbilang</label>
                            <textarea type="text" placeholder="Test" class="form-control" rows="2"></textarea>
                        </div>

                        <div class="col-sm-12 mt-4">
                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                            <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                            <a type="button" href="#" class="btn btn-warning me-1 mb-1">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
