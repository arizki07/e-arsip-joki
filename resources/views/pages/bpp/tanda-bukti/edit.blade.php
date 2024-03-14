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

    <div class="col-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h4 class="card-title">Pilih Pengajuan Yang Sudah Disetujui</h4>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <select class="form-select mt-1" name="td_id_pengajuan" id="id_pengajuan">
                        <option disabled>-- Pilih Pengajuan --</option>
                        @foreach ($pengajuans as $pengajuan)
                            <option value="{{ $pengajuan->id_pengajuan }}"
                                @if ($pengajuan->id_pengajuan == $buktiPengeluaran->td_id_pengajuan) selected @endif>{{ $pengajuan->p_nama_kegiatan }} -
                                {{ $pengajuan->getStatusBadge() }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{ $title }}</h4>
            </div>
            <div class="card-body">
                <div id="pengajuanDetails">
                    <form action="{{ route('bukti-bpp-pengeluaran.update', $buktiPengeluaran->id_td_bukti) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="basicInput">ID Pengajuan</label>
                            <input type="text" class="form-control mt-1" name="td_id_pengajuan"
                                value="{{ $buktiPengeluaran->td_id_pengajuan }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="basicInput">Nama Kegiatan</label>
                            <input type="text" class="form-control mt-1" name="td_nama_kegiatan"
                                value="{{ $namaKegiatan; }}">
                        </div>
                        <div class="form-group">
                            <label for="basicInput">Sub Kegiatan</label>
                            <input type="text" class="form-control mt-1" name="td_sub_kegiatan"
                                value="{{ $subKegiatan; }}">
                        </div>
                        <div class="form-group">
                            <label for="basicInput">Tanggal</label>
                            <input type="date" class="form-control mt-1" name="td_tanggal"
                                value="{{ $tglKegiatan; }}">
                        </div>
                        <div class="form-group">
                            <label for="basicInput">Jumlah Biaya</label>
                            <input type="text" class="form-control mt-1" name="td_biaya"
                                value="{{ $buktiPengeluaran->td_biaya }}">
                        </div>
                        <div class="form-group mt-3" id="uraianContainer">
                            <div class="d-flex justify-content-between align-items-center">
                                <label for="basicInput">Uraian</label>
                                <button type="button" class="btn btn-success" onclick="addUraianColumn()"><i
                                        class="bi bi-plus-square"></i> Tambah Uraian</button>
                            </div>
                            <div class="uraian-row">
                                <div class="row mt-2">
                                    @foreach($data as $item)
                                        <div class="col-md-6">
                                            <textarea rows="3" class="form-control mt-1" name="uraian_kegiatan[]" placeholder="Rincian Kode Rekening">{{ old('uraian_kegiatan', $item['uraian']) }}</textarea>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="text" class="form-control mt-1" name="uraian_kegiatan_jumlah[]"
                                                placeholder="Jumlah"
                                                value="{{ old('uraian_kegiatan_jumlah.0', $item['jumlah']) }}">
                                        </div>
                                    @endforeach
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-danger" onclick="removeUraianColumn(this)"><i
                                                class="bi bi-x-square"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-5 text-right">
                                {{-- <h5>Jumlah</h5> --}}
                            </div>
                            <div class="col-md-1 mt-2">
                                <p class="ms-5">Jumlah</p>
                            </div>
                            <div class="col-md-5">
                                <input type="text" class="form-control mt-1" id="total" name="total"
                                    placeholder="Total Jumlah"
                                    value="Rp {{ number_format($total, 0, ',', '.') }}" readonly>
                            </div>
                        </div>
                        <div class="col-sm-12 mt-4">
                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                            <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                            <a type="button" href="{{ url('pengajuan') }}"
                                class="btn btn-warning me-1 mb-1">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function formatRupiah(input) {
            let value = input.value.replace(/[^0-9]/g, "");

            if (value !== "") {
                value = parseInt(value, 10).toLocaleString("id-ID");

                value = value.replace(/,/g, ".");

                input.value = "Rp " + value;
            } else {
                input.value = "";
            }
        }

        function addUraianColumn() {
            var container = document.getElementById('uraianContainer');
            var uraianRow = document.createElement('div');
            uraianRow.classList.add('uraian-row');

            var rowDiv = document.createElement('div');
            rowDiv.classList.add('row');

            var textareaCol = document.createElement('div');
            textareaCol.classList.add('col-md-6');

            var textarea = document.createElement('textarea');
            textarea.setAttribute('rows', '3');
            textarea.setAttribute('class', 'form-control mt-1');
            textarea.setAttribute('name', 'uraian_kegiatan[]');
            textarea.setAttribute('placeholder', 'Rincian Kode Rekening');

            textareaCol.appendChild(textarea);

            var inputCol = document.createElement('div');
            inputCol.classList.add('col-md-5');

            var input = document.createElement('input');
            input.setAttribute('type', 'text');
            input.setAttribute('class', 'form-control mt-1');
            input.setAttribute('name', 'uraian_kegiatan_jumlah[]');
            input.setAttribute('placeholder', 'Jumlah');
            input.setAttribute('oninput', 'formatRupiah(this)');

            inputCol.appendChild(input);

            var buttonCol = document.createElement('div');
            buttonCol.classList.add('col-md-1');

            var button = document.createElement('button');
            button.setAttribute('type', 'button');
            button.setAttribute('class', 'btn btn-danger');
            button.setAttribute('onclick', 'removeUraianColumn(this)');

            var icon = document.createElement('i');
            icon.setAttribute('class', 'bi bi-x-square');

            button.appendChild(icon);
            buttonCol.appendChild(button);

            rowDiv.appendChild(textareaCol);
            rowDiv.appendChild(inputCol);
            rowDiv.appendChild(buttonCol);

            uraianRow.appendChild(rowDiv);

            container.appendChild(uraianRow);
        }

        function removeUraianColumn(button) {
            var uraianRow = button.closest('.uraian-row');
            uraianRow.remove();
        }
    </script>
@endsection
