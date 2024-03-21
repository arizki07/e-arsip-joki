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
                    <h3><i class="fa fa-users"></i> Data Users</h3>
                    <p class="text-subtitle text-muted">
                        Silahkan tambahkan data users dengan sesuai kebutuhan Instansi anda.
                    </p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data Users</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="fa fa-users"></i> Tambah User
                    </button>
                </div>
                <div class="card-body">
                    <div class="comment-wrapper">
                        @foreach ($pengguna as $item)
                            <div class="comment">
                                <div class="comment-header">
                                    <div class="pr-50">
                                        <div class="avatar avatar-2xl">
                                            <img src="{{ asset('template/dist/assets/compiled/jpg/2.jpg') }}"
                                                alt="Avatar">
                                        </div>
                                    </div>
                                    <div class="comment-body">

                                        <div class="comment-profileName">{{ $item->name }}</div>
                                        <div class="comment-time">{{ $item->email }}</div>
                                        <div class="comment-message">{{ $item->role }}</div>
                                        <div class="comment-actions">
                                            <button class="btn icon icon-left btn-primary me-2 text-nowrap"
                                                data-bs-toggle="modal" data-bs-target="#showUserModal{{ $item->id_users }}">
                                                <i class="bi bi-eye-fill"></i> Show
                                            </button>
                                            <button class="btn icon icon-left btn-warning me-2 text-nowrap"
                                                data-bs-toggle="modal" data-bs-target="#editUserModal{{ $item->id_users }}">
                                                <i class="bi bi-pencil-square"></i> Edit
                                            </button>

                                            <form id="deleteForm{{ $item->id_users }}" method="POST"
                                                action="/pengguna/destroy/{{ $item->id_users }}">
                                                @csrf
                                                @method('DELETE')
                                                <a href="#" class="btn icon icon-left btn-danger me-2 text-nowrap"
                                                    onclick="confirmDelete({{ $item->id_users }})"><i
                                                        class="bi bi-x-circle"></i> Delete</a>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <br>

                        @foreach ($pengguna as $item)
                            {{-- Show Modal --}}
                            <div class="modal fade" id="showUserModal{{ $item->id_users }}" tabindex="-1"
                                aria-labelledby="showUserModalLabel{{ $item->id_users }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="showUserModalLabel{{ $item->id_users }}">User
                                                Details
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- User details go here -->
                                            <form>
                                                <div class="mb-3">
                                                    <label for="name" class="form-label">Name:</label>
                                                    <input type="text" class="form-control" id="name"
                                                        value="{{ $item->name }}" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Email:</label>
                                                    <input type="email" class="form-control" id="email"
                                                        value="{{ $item->email }}" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="role" class="form-label">Role:</label>
                                                    <input type="text" class="form-control" id="role"
                                                        value="{{ $item->role }}" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="password" class="form-label">Password:</label>
                                                    <input type="text" class="form-control" id="password"
                                                        value="{{ $item->password }}" readonly>
                                                </div>
                                                <!-- Add any additional form fields here -->

                                                <!-- Add submit button if you want to perform actions on the form -->
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Edit modal -->

                            <div class="modal fade" id="editUserModal{{ $item->id_users }}" tabindex="-1"
                                aria-labelledby="editUserModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editUserModalLabel">Edit
                                                User
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="{{ route('update.users', $item->id_users) }}">
                                                @csrf
                                                @method('POST')
                                                <div class="mb-3">
                                                    <label for="name" class="form-label">Name:</label>
                                                    <input type="text" class="form-control" id="name"
                                                        name="name" value="{{ $item->name }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Email:</label>
                                                    <input type="email" class="form-control" id="email"
                                                        name="email" value="{{ $item->email }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="role" class="form-label">Role:</label>
                                                    <select class="form-select" id="role" name="role" required>
                                                        <option value="admin"
                                                            {{ $item->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                                        <option value="bp"
                                                            {{ $item->role == 'bp' ? 'selected' : '' }}>BP</option>
                                                        <option value="bpp"
                                                            {{ $item->role == 'bpp' ? 'selected' : '' }}>BPP</option>
                                                        <option value="kpa"
                                                            {{ $item->role == 'kpa' ? 'selected' : '' }}>KPA</option>
                                                        <option value="pa"
                                                            {{ $item->role == 'pa' ? 'selected' : '' }}>PA</option>
                                                        <option value="pptk"
                                                            {{ $item->role == 'pptk' ? 'selected' : '' }}>PPTK</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="password" class="form-label">Password:</label>
                                                    <input type="text" class="form-control" id="password"
                                                        name="password" value="{{ $item->password }}" required>
                                                </div>
                                                <!-- Add any additional form fields here -->
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- Modal tambah-->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="/pengguna/store/">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="col-form-label">Nama:</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="col-form-label">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="col-form-label">Password:</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="role" class="col-form-label">Role:</label>
                            <select class="form-select" id="role" name="role">
                                <option value="admin">Admin</option>
                                <option value="bp">BP</option>
                                <option value="bpp">BPP</option>
                                <option value="kpa">KPA</option>
                                <option value="pa">PA</option>
                                <option value="pptk">PPTK</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
