@extends('layouts.main')
@section('content')
    @include('component.alerts')

    <div class="col-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">

                            <h3>User / View /{{ $title }}</h3>
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
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <!-- User Sidebar -->
            @foreach ($biodata as $item)
                <div class="row">
                    <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
                        <!-- User Card -->
                        <div class="card mb-5" style="width: 250px;">
                            <div class="card-body">
                                <div class="user-avatar-section text-center">
                                    <div class="d-flex align-items-center flex-column">
                                        <img class="img-fluid rounded-circle mb-3"
                                            src="{{ asset('template/dist/assets/img/avatars/5.png') }}" height="100"
                                            width="100" alt="User avatar" />
                                        <div class="user-info">
                                            <h4 class="mb-2">Hello {{ $item->nama }} 🎉</h4>
                                            <span class="badge bg-label-secondary mt-1">Author</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /User Card -->
                    </div>
                    <!--/ User Sidebar -->

                    <!-- User Content -->
                    <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
                        <div class="card mb-4">
                            <h5 class="card-header">{{ $title }}</h5>
                            <div class="card-body">
                                <form>
                                    <div class="row">
                                        <div class="mb-3 col-12 col-sm-6">
                                            <label for="nama" class="form-label">Nama Lengkap</label>
                                            <input type="text" class="form-control" id="nama"
                                                value="{{ $item->nama }}" aria-describedby="defaultFormControlHelp"
                                                readonly />
                                        </div>
                                        <div class="mb-3 col-12 col-sm-6">
                                            <label for="jabatan" class="form-label">Jabatan</label>
                                            <input type="text" class="form-control" id="jabatan"
                                                value="{{ $item->jabatan->kode }}" aria-describedby="defaultFormControlHelp"
                                                readonly />
                                        </div>
                                        <div class="mb-3 col-12 col-sm-6">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="text" class="form-control" id="email"
                                                value="{{ $item->email }}" aria-describedby="defaultFormControlHelp"
                                                readonly />
                                        </div>
                                        <div class="mb-3 col-12 col-sm-6">
                                            <label for="nip" class="form-label">NIP</label>
                                            <input type="text" class="form-control" id="nip"
                                                value="{{ $item->nip }}" aria-describedby="defaultFormControlHelp"
                                                readonly />
                                        </div>
                                        <div class="mb-3 col-12 col-sm-6">
                                            <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                                            <input type="text" class="form-control" id="tgl_lahir"
                                                value="{{ $item->tgl_lahir }}" aria-describedby="defaultFormControlHelp"
                                                readonly />
                                        </div>
                                        <div class="mb-3 col-12 col-sm-6">
                                            <label for="alamat" class="form-label">Alamat</label>
                                            <input type="text" class="form-control" id="alamat"
                                                value="{{ $item->alamat }}" aria-describedby="defaultFormControlHelp"
                                                readonly />
                                        </div>
                                        <div class="col-12">
                                            <a href="javascript:;" class="btn btn-success me-3" data-bs-target="#editUser"
                                                data-bs-toggle="modal"><i class="fas fa-edit"></i></a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--/ User Content -->
                </div>
            @endforeach
        </div>

        <!-- Modal -->
        <!-- Edit User Modal -->
        <div class="modal fade" id="editUser" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-simple modal-edit-user">
                <div class="modal-content p-3 p-md-5">
                    <div class="modal-body">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="text-center mb-4">
                            <h3 class="mb-2">Edit Profile Biodata</h3>
                            <p class="text-muted">Silahkan Edit Profile Anda.</p>
                        </div>
                        <form action="{{ route('biodata-update', ['id' => $item->id_biodata]) }}" id="editUserForm"
                            class="row g-3" method="post">
                            @csrf

                            <div class="col-12">
                                <label for="basicInput">Nama Lengkap</label>
                                <input type="text" class="form-control mt-1" name="nama" id="basicInput"
                                    placeholder="Nama Lengkap" value="{{ $item->nama }}">
                            </div>
                            <div class="col-12">
                                <label for="basicInput">Jabatan</label>
                                <select class="form-select mt-1" name="jabatan_id">
                                    <option selected disabled>-- Pilih Jabatan ---</option>
                                    @foreach ($jabatan as $jab)
                                        <option value="{{ $jab->id_jabatan }}"
                                            @if ($jab->id_jabatan == $item->jabatan_id) selected @endif>
                                            {{ $jab->kode }} - {{ $jab->nama_jabatan }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="basicInput">Email Aktif</label>
                                <input type="email" class="form-control mt-1" name="email" id="basicInput"
                                    placeholder="Cth : example@gmail.com" value="{{ $item->email }}">
                            </div>
                            <div class="col-12">
                                <label for="basicInput">Nomor Induk Pegawai (NIP)</label>
                                <input type="number" class="form-control mt-1" name="nip" id="basicInput"
                                    placeholder="19051109" value="{{ $item->nip }}">
                            </div>
                            <div class="col-12">
                                <label for="basicInput">Tanggal Lahir</label>
                                <input type="date" class="form-control mt-1" name="tgl_lahir" id="basicInput"
                                    placeholder="Tanggal Lahir Pegawai" value="{{ $item->tgl_lahir }}">
                            </div>
                            <div class="col-12">
                                <label for="basicInput">Alamat Lengkap</label>
                                <textarea type="text" rows="3" class="form-control mt-1" name="alamat" id="basicInput"
                                    placeholder="Alamat Lengkap">{{ $item->alamat }}</textarea>
                            </div>
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal"
                                    aria-label="Close">
                                    Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Edit User Modal -->
    </div>
    <!--/ Add New Credit Card Modal -->
@endsection
