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
                <form action="{{ route('create-biodata') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="basicInput">Nama Lengkap</label>
                        <input type="text" class="form-control mt-1" name="nama" id="basicInput"
                            placeholder="Nama Lengkap" value="{{ old('nama') }}">
                    </div>
                    <div class="form-group">
                        <label for="basicInput">Jabatan</label>
                        <select class="form-select mt-1" name="jabatan_id">
                            <option selected disabledabled>-- Pilih Jabatan ---</option>
                            @foreach ($jabatan as $jab)
                                <option value="{{ $jab->id_jabatan }}">{{ $jab->kode }} - {{ $jab->nama_jabatan }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="basicInput">Email Aktif</label>
                        <input type="email" class="form-control mt-1" name="email" id="basicInput"
                            placeholder="Cth : example@gmail.com" value="{{ old('email') }}">
                    </div>
                    <div class="form-group">
                        <label for="basicInput">Nomor Induk Pegawai (NIP)</label>
                        <input type="number" class="form-control mt-1" name="nip" id="basicInput"
                            placeholder="19051109" value="{{ old('nip') }}">
                    </div>
                    <div class="form-group">
                        <label for="basicInput">Tanggal Lahir</label>
                        <input type="date" class="form-control mt-1" name="tgl_lahir" id="basicInput"
                            placeholder="Tanggal Lahir Pegawai" value="{{ old('tgl_lahir') }}">
                    </div>
                    <div class="form-group">
                        <label for="basicInput">Alamat Lengkap</label>
                        <textarea type="text" rows="3" class="form-control mt-1" name="alamat" id="basicInput"
                            placeholder="Alamat Lengkap">{{ old('alamat') }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="foto_ttd" class="form-label">Foto TTD</label>
                        <input class="form-control form-control-sm" id="foto_ttd" name="foto_ttd" type="file">
                    </div>
                    <div class="col-sm-12 mt-4">
                        <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                        <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                        <a type="button" href="{{ url('biodata') }}" class="btn btn-warning me-1 mb-1">Kembali</a>
                    </div>

                </form>
            </div>
        </div>
    </section>
@endsection
