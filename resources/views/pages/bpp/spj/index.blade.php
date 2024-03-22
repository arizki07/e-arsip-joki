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
                    <h3>Data SPJ</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data SPJ</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        Data SPJ
                    </h5>
                    <div>
                        <a type="button" class="btn btn-primary ms-auto me-4" href="#" data-bs-toggle="modal"
                            data-bs-target="#primary">
                            <i class="bi bi-journal-plus"></i> Add / Edit SPJ
                        </a>
                        {{-- <a type="button" class="btn btn-primary me-2" href="#" data-bs-toggle="modal" data-bs-target="#primary">
                            <i class="bi bi-person-plus"></i> Tambah SPJ
                        </a> --}}
                        <a type="button" class="btn btn-primary" href="/bioSpj">
                            <i class="bi bi-printer"></i> Daftar Biodata
                        </a>
                    </div>
                </div>         
                <br>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="table1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No Surat</th>
                                    <th>No Spj</th>
                                    <th>Perihal</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($spj as $item)
                                <tr>
                                    <td>{{ $i++; }}</td>
                                    <td>{{ $item->nomor_surat }}</td>
                                    <td>{{ $item->id_surat_pengantar }}</td>
                                    <td>{{ $item->perihal }}</td>
                                    <td>
                                        <a href="spj-bpp-view/{{ $item->id_surat_pengantar }}" class="btn icon btn-secondary"><i class="bi bi-eye"></i></a>
                                        <a href="#" class="btn icon btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#print-{{ $item->id_surat_pengantar }}"><i class="bi bi-printer"></i></a>
                                        {{-- <a href="#" class="btn icon btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#delete-{{ $item->id_surat_pengantar }}"><i class="bi bi-trash"></i></a> --}}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('scripts')
<div class="modal fade text-left" id="primary" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
        role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title white" id="myModalLabel160">Input / Edit SPJ With Excel
                </h5>
                <div class="btn-group mb-1">
                    <div class="dropdown">
                        <button class="btn btn-light btn-sm dropdown-toggle me-1" type="button"
                            id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            Download Xlsx
                        </button>
                        <div class="dropdown-menu bg-light" aria-labelledby="dropdownMenuButton">
                            <a type="button" class="dropdown-item" href="{{ asset('dokumen/excel/TEMPLATE-ADD-(KOSONGAN).xlsx') }}" download>
                                <i class="bi bi-file-earmark-spreadsheet"></i> Template (KOSONGAN)
                            </a>
                            <a type="button" class="dropdown-item" href="{{ asset('dokumen/excel/TEMPLATE-ADD-(DATA-SAMPLE).xlsx') }}" download>
                                <i class="bi bi-file-earmark-spreadsheet"></i> Template (SAMPLE)
                            </a>
                            <a type="button" class="dropdown-item" href="{{ asset('dokumen/excel/TEMPLATE-UPDATE-(KOSONGAN).xlsx') }}" download>
                                <i class="bi bi-file-earmark-spreadsheet"></i> Template Update (KOSONGAN)
                            </a>
                            <a type="button" class="dropdown-item" href="{{ asset('dokumen/excel/TEMPLATE-UPDATE-(DATA-SAMPLE).xlsx') }}" download>
                                <i class="bi bi-file-earmark-spreadsheet"></i> Template Update (DATA SAMPLE)
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('impor.spj') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="type">Tipe Proses</label>
                        <div class="d-flex align-items-center mb-2">
                            <div class="form-check me-3 mt-2">
                                <input class="form-check-input" type="radio" name="type" id="typeAdd" value="add">
                                <label class="form-check-label" for="typeAdd">Add</label>
                            </div>
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="radio" name="type" id="typeUpdate" value="update">
                                <label class="form-check-label" for="typeUpdate">Update</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="import">Upload Excel File</label>
                        <input type="file" name="file" accept=".xlsx,.xls" class="form-control mt-1" required>
                    </div>
                    <small class="text-danger">*Note : Edit Excel (Pastikan Nomor SPJ Sama dengan Nomor Surat Pengantar yang dituju.)</small><br>
                    <small class="text-danger">*Note : Silahkan Download Template Excel yang sudah disediakan!.</small>
                    {{-- <button type="submit" class="btn btn-primary mt-2">Import Data</button> --}}
                    <div class="modal-footer mt-4">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                        <button type="submit" class="btn btn-primary ms-1">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Import</span>
                        </button>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>
</div>

@foreach ($spj as $item)
<div class="modal fade text-left" id="delete-{{ $item->id_surat_pengantar }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
        role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title white" id="myModalLabel160">Konfirmasi Penghapusan Data SPJ
                </h5>
            </div>
            <div class="modal-body">
                <p>Yakin ingin menghapus data SPJ ini? Data akan terhapus secarra permanen.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary"
                    data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Close</span>
                </button>
                <a type="button" href="/spj/delete/{{ $item->id_surat_pengantar }}" class="btn btn-danger ms-1">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Hapus</span>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade text-left" id="print-{{ $item->id_surat_pengantar }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
        role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title white" id="myModalLabel160">SPJ Nomor ID-{{ $item->id_surat_pengantar }}</h5>
                <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
            </div>
            <div class="modal-body">
                <p>Silahkan pilih data yang ingin dicetak dalam bentuk file.</p>
                <div class="modal-footer">
                    <a type="button" href="/spj/bpp/export/document/{{ $item->id_surat_pengantar }}?typeSPJ=spj_surat_pengantar" class="btn btn-primary ms-1">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block"><i class="bi bi-printer"></i> SPJ Surat Pengantar</span>
                    </a>
                    <a type="button" href="/spj/bpp/export/document/{{ $item->id_surat_pengantar }}?typeSPJ=spj_bku" class="btn btn-success ms-1">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block"><i class="bi bi-printer"></i> SPJ BKU</span>
                    </a>
                    <a type="button" href="/spj/bpp/export/document/{{ $item->id_surat_pengantar }}?typeSPJ=spj_fungsional" class="btn btn-warning ms-1">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block"><i class="bi bi-printer"></i> SPJ Fungsional</span>
                    </a>
                    <a type="button" href="/spj/bpp/export/document/{{ $item->id_surat_pengantar }}?typeSPJ=spj_register_kas" class="btn btn-danger ms-1">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block"><i class="bi bi-printer"></i> SPJ Register Kas</span>
                    </a>
                    <a type="button" href="/spj/bpp/export/document/{{ $item->id_surat_pengantar }}?typeSPJ=spj_all" class="btn btn-light ms-1">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block"><i class="bi bi-printer"></i> All SPJ No ID-{{ $item->id_surat_pengantar }}</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
    @endforeach
@endsection
