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
                <div class="card-header">
                    <h5 class="card-title">
                        Data SPJ
                    </h5>
                </div>
                {{-- <a type="button" class="btn btn-primary ms-auto me-4" href="/spj/create"  data-bs-toggle="modal"
                data-bs-target="#primary"> --}}
                <a type="button" class="btn btn-primary ms-auto me-4" href="#" data-bs-toggle="modal"
                    data-bs-target="#primary">
                    <i class="bi bi-user"></i> Tambah SPJ
                </a>

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
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $item->nomor_surat }}</td>
                                        <td>{{ $item->id_surat_pengantar }}</td>
                                        <td>{{ $item->perihal }}</td>
                                        <td>
                                            <a href="kpa-spj/view/{{ $item->id_surat_pengantar }}"
                                                class="btn icon btn-secondary"><i class="bi bi-eye"></i></a>
                                            {{-- <a href="#" class="btn icon btn-success"><i class="bi bi-pencil"></i></a> --}}
                                            {{-- <a href="#" class="btn icon btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#delete-{{ $item->id_surat_pengantar }}"><i
                                                    class="bi bi-trash"></i></a> --}}
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
