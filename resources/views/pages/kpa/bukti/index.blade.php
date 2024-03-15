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
                        <a type="button" href="{{ route('bukti.create') }}" class="btn btn-primary" style="float: right;">
                            <i class="bi bi-user"></i> Tambah {{ $title }}
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
                                <th>Status</th>
                                {{-- <th>Action</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach ($buktiPengeluarans as $item)
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td>{{ $item->bukti->p_nama_kegiatan }}</td>
                                    <td>{{ $item->bpp->nama }}</td>
                                    <td>{{ $item->bukti->p_tanggal }}</td>
                                    <td>
                                        <a href="{{ route('export.buktiPeng.kpa') }}" type="button"
                                            class="btn btn-outline-success"><i class="fas fa fa-file-excel"></i></a>
                                        <a href="{{ route('export.word.buktiPeng.kpa', ['id' => $item->id_td_bukti]) }}"
                                            type="button" class="btn btn-outline-primary"><i
                                                class="fas fa fa-file-word"></i></a>
                                        <a href="{{ route('export.pdf.buktiPeng.kpa', ['id' => $item->id_td_bukti]) }}"
                                            type="button" class="btn btn-outline-danger"><i
                                                class="fas fa fa-file-pdf"></i></a>
                                    </td>
                                    <td>
                                        @if ($item->bukti->status == 1)
                                            <span class="badge bg-warning">Pending Verifikasi</span>
                                        @elseif ($item->bukti->status == 2)
                                            <span class="badge bg-warning">Pending KPA</span>
                                        @elseif ($item->bukti->status == 3)
                                            <span class="badge bg-warning">Pending PA</span>
                                        @elseif ($item->bukti->status == 4)
                                            <span class="badge bg-primary">Approve</span>
                                        @endif
                                    </td>
                                    {{-- <td>
                                        <a href="#" class="btn icon btn-secondary"><i class="bi bi-eye"></i></a>
                                        <a href="{{ route('bukti-pengeluaran.edit', $item->id_td_bukti) }}"
                                            class="btn icon btn-primary">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form id="verifikasiForm{{ $item->bukti->id_pengajuan }}"
                                            action="{{ route('acc.kpa', ['id' => $item->bukti->id_pengajuan]) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('POST')
                                            @if ($item->bukti->status == 2)
                                                <button type="submit" class="btn icon btn-success">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            @else
                                                <button type="button" class="btn icon btn-success" disabled>
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            @endif
                                        </form>
                                    </td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
