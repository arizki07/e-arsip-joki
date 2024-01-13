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
                        <a type="button" href="{{ route('add-biodata') }}" class="btn btn-primary" style="float: right;">
                            <i class="bi bi-user"></i> Tambah Data
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
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>NIP</th>
                                <th>Email</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1; @endphp
                            @foreach ($biodata as $item)
                                @php
                                    $displayRow = false;
                                    $kodeJabatan = '';
                                    foreach ($jabatan as $jab) {
                                        if ($jab['id_jabatan'] == $item['jabatan_id']) {
                                            $kodeJabatan = $jab['kode'];
                                            if ($active == 'BP' && $kodeJabatan == 'BP') {
                                                $displayRow = true;
                                            } elseif ($active != 'BP') {
                                                $displayRow = true;
                                            }
                                            break;
                                        }
                                    }
                                @endphp

                                @if ($displayRow)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $item['nama'] }}</td>
                                        <td>{{ $kodeJabatan }}</td>
                                        <td>{{ $item['nip'] }}</td>
                                        <td>{{ $item['email'] }}</td>
                                        <td>
                                            <a href="{{ route('edit-biodata', ['id' => $item->id_biodata]) }}"
                                                class="btn icon btn-success"><i class="bi bi-pencil"></i></a>
                                            <a href="#" data-bs-toggle="modal"
                                                data-bs-target="#delete-{{ $item['id_biodata'] }}"
                                                class="btn icon btn-danger"><i class="bi bi-trash"></i></a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
