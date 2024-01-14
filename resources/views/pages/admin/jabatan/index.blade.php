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
                        <button type="button" class="btn btn-primary" style="float: right;" data-bs-toggle="modal"
                            data-bs-target="#tambahbp">
                            <i class="bi bi-user"></i> Tambah {{ $title }}
                        </button>
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
                                <th>Kode</th>
                                <th>Jabatan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1; @endphp
                            @foreach ($jabatan as $item)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $item['kode'] }}</td>
                                    <td>{{ $item['nama_jabatan'] }}</td>
                                    <td>
                                        <a href="#" data-bs-toggle="modal"
                                            data-bs-target="#edit-{{ $item['id_jabatan'] }}" class="btn icon btn-success"><i
                                                class="bi bi-pencil"></i></a>
                                        <a href="#" data-bs-toggle="modal"
                                            data-bs-target="#delete-{{ $item['id_jabatan'] }}"
                                            class="btn icon btn-danger"><i class="bi bi-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    {{-- MODAL ADD --}}
    <div class="modal fade" id="tambahbp" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-l">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah {{ $title }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('add-jabatan') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Kode Jabatan</label>
                            <input type="text" class="form-control" name="kode" id="recipient-name" required>
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Nama Jabatan</label>
                            <input type="text" class="form-control" name="nama_jabatan" id="recipient-name" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @foreach ($jabatan as $item)
        {{-- MODAL UPDATE --}}
        <div class="modal fade" id="edit-{{ $item['id_jabatan'] }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-l">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit {{ $title }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('edit-jabatan', $item->id_jabatan) }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Kode Jabatan</label>
                                <input type="text" class="form-control" name="kode" id="recipient-name"
                                    value="{{ $item->kode }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Nama Jabatan</label>
                                <input type="text" class="form-control" name="nama_jabatan" id="recipient-name"
                                    value="{{ $item->nama_jabatan }}" required>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- MODAL DELETE --}}
        <div class="modal fade" id="delete-{{ $item['id_jabatan'] }}" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-l">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Penghapusan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Yakin ingin menghapus data ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Batal</span>
                        </button>
                        <a type="button" href="{{ route('delete-jabatan', $item->id_jabatan) }}"
                            class="btn btn-danger ms-1">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Hapus</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
