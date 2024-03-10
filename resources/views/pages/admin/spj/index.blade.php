@extends('layouts.main')
@section('content')
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
                <a type="button" class="btn btn-primary ms-auto me-4" href="#"  data-bs-toggle="modal"
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
                                    <th>Nama</th>
                                    <th>Role</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Graiden</td>
                                    <td>vehicula.aliquet@semconsequat.co.uk</td>
                                    <td>076 4820 8838</td>
                                    <td>Offenburg</td>
                                    <td>
                                        <a href="#" class="btn icon btn-success"><i class="bi bi-pencil"></i></a>
                                        <a href="#" class="btn icon btn-danger"><i class="bi bi-trash"></i></a>


                                    </td>
                                </tr>
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
                <h5 class="modal-title white" id="myModalLabel160">Input Excel SPJ
                </h5>
                <button type="button" class="btn btn-light btn-sm" href="#">
                    Download Template
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('import') }}" enctype="multipart/form-data">
                    @csrf
                    <label for="import">Upload Excel File</label>
                    <input type="file" name="file" class="form-control mt-2" required>
                    {{-- <button type="submit" class="btn btn-primary mt-2">Import Data</button> --}}
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary"
                            data-bs-dismiss="modal">
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
@endsection
