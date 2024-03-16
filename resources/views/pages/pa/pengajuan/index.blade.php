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
                                        <a href="{{ route('export.pengajuan.pa') }}" type="button"
                                            class="btn btn-outline-success"><i class="fas fa fa-file-excel"></i></a>
                                        <a href="{{ route('export.word.pengajuan.pa', ['id' => $item->id_pengajuan]) }}"
                                            type="button" class="btn btn-outline-primary"><i
                                                class="fas fa fa-file-word"></i></a>
                                        <a href="{{ route('export.pdf.pengajuan.pa', ['id' => $item->id_pengajuan]) }}"
                                            type="button" class="btn btn-outline-danger"><i
                                                class="fas fa fa-file-pdf"></i></a>
                                    </td>
                                    <td>
                                        @if ($item->status == 1)
                                            <span class="badge bg-warning">Pending Verifikasi</span>
                                        @elseif ($item->status == 2)
                                            <span class="badge bg-warning">Pending KPA</span>
                                        @elseif ($item->status == 3)
                                            <span class="badge bg-warning">Pending PA</span>
                                        @elseif ($item->status == 4)
                                            <span class="badge bg-success">Approve</span>
                                        @elseif ($item->status == 5)
                                            <span class="badge bg-danger">Reject</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#detailModal{{ $item->id }}">
                                            <i class="bi bi-eye"></i>
                                        </button>

                                        <form id="verifikasiForm{{ $item->id_pengajuan }}"
                                            action="{{ route('kpa-acc-pa', ['id' => $item->id_pengajuan]) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('POST')
                                            @if ($item->status == 3)
                                                <button type="submit" class="btn icon btn-success">
                                                    <i class="fas fa-thumbs-up"></i>
                                                </button>
                                            @else
                                                <button type="button" class="btn icon btn-success" disabled>
                                                    <i class="fas fa-thumbs-up"></i>
                                                </button>
                                            @endif
                                        </form>
                                        <form id="rejectForm{{ $item->id_pengajuan }}"
                                            action="{{ route('reject.pa', ['id' => $item->id_pengajuan]) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('POST')
                                            <button type="submit" class="btn icon btn-danger">
                                                <i class="fas fa-thumbs-down"></i>
                                            </button>
                                        </form>

                                        {{-- <a href="#" class="btn icon btn-danger"><i class="fas fa-times"></i></a> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    @foreach ($pengajuan as $item)
        <div class="modal fade" id="detailModal{{ $item->id }}" tabindex="-1"
            aria-labelledby="detailModalLabel{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailModalLabel{{ $item->id }}">Detail Pengajuan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label for="p_nama_kegiatan" class="col-form-label">Nama Kegiatan:</label>
                                <input type="text" class="form-control" id="p_nama_kegiatan"
                                    value="{{ $item->p_nama_kegiatan }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="bpp" class="col-form-label">Badan Pengeluaran Pembantu:</label>
                                <input type="text" class="form-control" id="bpp" value="{{ $item->bpp->nama }}"
                                    readonly>
                            </div>
                            <div class="mb-3">
                                <label for="p_tanggal" class="col-form-label">Tanggal:</label>
                                <input type="text" class="form-control" id="p_tanggal" value="{{ $item->p_tanggal }}"
                                    readonly>
                            </div>
                            <div class="mb-3">
                                <label for="status" class="col-form-label">Status:</label>
                                <div class="input-group">
                                    <span class="form-control">
                                        @if ($item->status == 1)
                                            <span class="badge bg-warning">Pending Verifikasi</span>
                                        @elseif ($item->status == 2)
                                            <span class="badge bg-warning">Pending KPA</span>
                                        @elseif ($item->status == 3)
                                            <span class="badge bg-warning">Pending PA</span>
                                        @elseif ($item->status == 4)
                                            <span class="badge bg-success">Approve</span>
                                        @endif
                                    </span>
                                </div>
                            </div>
                            <div class="text-center">
                                <a href="{{ route('export.pengajuan.pa') }}" type="button"
                                    class="btn btn-outline-success">
                                    <i class="fas fa-file-excel"></i> Export to Excel
                                </a>
                                <a href="{{ route('export.word.pengajuan.pa', ['id' => $item->id_pengajuan]) }}"
                                    type="button" class="btn btn-outline-primary">
                                    <i class="fas fa-file-word"></i> Export to Word
                                </a>
                                <a href="{{ route('export.pdf.pengajuan.pa', ['id' => $item->id_pengajuan]) }}"
                                    type="button" class="btn btn-outline-danger">
                                    <i class="fas fa-file-pdf"></i> Export to PDF
                                </a>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Understood</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
