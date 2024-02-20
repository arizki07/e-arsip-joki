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
                    <div class="col-12 col-md-12">
                        <a type="button" href="{{ route('pengajuans.create') }}" class="btn btn-primary"
                            style="float: right;">
                            <i class="bi bi-user"></i> Tambah Data Pengajuan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kegiatan</th>
                                <th>Badan Pengeluaran Pembantu</th>
                                <th>Tanggal</th>
                                <th>Export</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach ($pengajuan as $item)
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td>{{ $item->p_nama_kegiatan }}</td>
                                    <td>{{ $item->bpp->nama }}</td>
                                    <td>{{ $item->p_tanggal }}</td>
                                    <td>
                                        <a href="{{ route('export.pengajuan') }}" type="button"
                                            class="btn btn-outline-success"><i class="fas fa fa-file-excel"></i></a>
                                        <a href="{{ route('export.word.pengajuan', ['id' => $item->id_pengajuan]) }}"
                                            type="button" class="btn btn-outline-primary"><i
                                                class="fas fa fa-file-word"></i></a>
                                        <a href="{{ route('export.pdf.pengajuan', ['id' => $item->id_pengajuan]) }}"
                                            type="button" class="btn btn-outline-danger"><i
                                                class="fas fa fa-file-pdf"></i></a>
                                    </td>
                                    <td>
                                        <a href="#" class="btn icon btn-secondary"><i class="bi bi-eye"></i></a>
                                        <a href="{{ route('pengajuans.edit', ['id' => $item->id_pengajuan]) }}"
                                            class="btn icon btn-success"><i class="bi bi-pencil"></i></a>
                                        <form id="deleteForm{{ $item->id_pengajuan }}"
                                            action="{{ route('pengajuans.delete', ['id' => $item->id_pengajuan]) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <a href="#" class="btn icon btn-danger"
                                                onclick="confirmDelete({{ $item->id_pengajuan }})">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
