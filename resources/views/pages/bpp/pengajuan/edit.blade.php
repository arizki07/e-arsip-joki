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

    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{ $title }}</h4>
            </div>

            <div class="card-body">
                <form action="{{ route('pengajuans.update', ['id' => $pengajuan->id_pengajuan]) }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="basicInput">Nama Kegiatan</label>
                        <input type="text" class="form-control mt-1" name="nd_nama_kegiatan" id="basicInput"
                            value="{{ $notaDinas->nd_nama_kegiatan }}" placeholder="Nama Kegiatan">
                    </div>
                    <div class="form-group">
                        <label for="basicInput">Sub Kegiatan</label>
                        <input type="text" class="form-control mt-1" name="nd_sub_kegiatan" id="basicInput"
                            value="{{ $notaDinas->nd_sub_kegiatan }}" placeholder="Sub Kegiatan">
                    </div>
                    <div class="form-group">
                        <label for="basicInput">Perihal</label>
                        <input type="text" class="form-control mt-1" name="nd_perihal" id="basicInput"
                            value="{{ $notaDinas->nd_perihal }}" placeholder="Perihal">
                    </div>
                    <div class="form-group">
                        <label for="basicInput">Nomor Nota</label>
                        <input type="text" class="form-control mt-1" name="nd_nomor_nota" id="basicInput"
                            value="{{ $notaDinas->nd_nomor_nota }}" placeholder="Nomor Nota">
                    </div>
                    <div class="form-group">
                        <label for="basicInput">Tanggal</label>
                        <input type="date" class="form-control mt-1" name="nd_tanggal" id="basicInput"
                            placeholder="Tanggal" value="{{ $notaDinas->nd_tanggal }}">
                    </div>
                    <div class="form-group">
                        <label for="basicInput">Jumlah Biaya</label>
                        <input type="text" class="form-control mt-1" name="nd_jumlah_biaya" id="basicInput"
                            value="{{ $notaDinas->nd_jumlah_biaya }}" placeholder="Jumlah Biaya"
                            oninput="formatRupiah(this)">
                    </div>
                    <div class="form-group">
                        <label for="basicInput">Uraian Kegiatan</label>
                        <textarea type="text" rows="3" class="form-control mt-1" name="nd_uraian_kegiatan" id="basicInput"
                            placeholder="Uraian Kegiatan">{{ $notaDinas->nd_uraian_kegiatan }}</textarea>
                    </div>
                    <div class="col-sm-12 mt-4">
                        <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                        <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                        <a type="button" href="{{ url('pengajuan') }}" class="btn btn-warning me-1 mb-1">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        function formatRupiah(input) {
            let value = input.value.replace(/[^0-9]/g, "");

            if (value !== "") {
                value = parseInt(value, 10).toLocaleString("id-ID");

                value = value.replace(/,/g, ".");

                input.value = "Rp " + value;
            } else {
                input.value = "";
            }
        }
    </script>
@endsection
