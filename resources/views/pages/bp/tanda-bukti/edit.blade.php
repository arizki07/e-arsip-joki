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
                    <form action="{{ route('bukti-bp-pengeluaran.update', $buktiPengeluaran->id_td_bukti) }}"
                        method="post">
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
                                value="{{ $namaKegiatan }}">
                        </div>
                        <div class="form-group">
                            <label for="basicInput">Sub Kegiatan</label>
                            <input type="text" class="form-control mt-1" name="td_sub_kegiatan"
                                value="{{ $subKegiatan }}">
                        </div>
                        <div class="form-group">
                            <label for="basicInput">Tanggal</label>
                            <input type="date" class="form-control mt-1" name="td_tanggal" value="{{ $tglKegiatan }}">
                        </div>
                        <div class="form-group">
                            <label for="basicInput">Jumlah Biaya</label>
                            <input type="text" class="form-control mt-1" name="td_biaya"
                                value="{{ $buktiPengeluaran->td_biaya }}">
                        </div>
                        <div class="form-group">
                            <label for="basicInput">No Surat Bukti Pengeluaran</label>
                            <input type="text" class="form-control mt-1" name="no_bukti" id="no_bukti"
                                value="{{ $buktiPengeluaran->no_bukti }}" placeholder="No Surat Bukti Pengeluaran">
                        </div>
                        <div class="form-group mt-3" id="uraianContainer">
                            <div class="d-flex justify-content-between align-items-center">
                                <label for="basicInput">Uraian</label>
                                <button type="button" class="btn btn-success" onclick="addUraianColumn()"><i
                                        class="bi bi-plus-square"></i> Tambah Uraian</button>
                            </div>
                            <div class="uraian-row">
                                <div class="row mt-2">
                                    @foreach ($data as $item)
                                        <div class="col-md-6">
                                            <textarea rows="3" class="form-control mt-1" name="uraian_kegiatan[]" placeholder="Rincian Kode Rekening">{{ old('uraian_kegiatan', $item['uraian']) }}</textarea>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="text" class="form-control mt-1 uraian-input"
                                                name="uraian_kegiatan_jumlah[]" id="uraian_kegiatan_jumlah[]"
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
                        <div class="form-group">
                            <div class="row mt-2">
                                <div class="col-md-4 text-right">
                                    {{-- <h5>Jumlah</h5> --}}
                                </div>
                                <div class="col-md-2 mt-2">
                                    <p class="ms-5">Jumlah :</p>
                                </div>
                                <div class="col-md-5">
                                    <input type="text" readonly class="form-control mt-1 total" id="total"
                                        name="total" placeholder="Total Jumlah"
                                        value="{{ $buktiPengeluaran->total_uraian }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 mt-4">
                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                            <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                            <a type="button" href="{{ url('bukti-bp') }}" class="btn btn-warning me-1 mb-1">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Menangani perubahan pada input jumlah uraian
            document.getElementsByName('uraian_kegiatan_jumlah[]').forEach(function(input) {
                // Simpan nilai asli ke atribut data-original-value saat halaman dimuat
                input.setAttribute('data-original-value', input.value);
                input.addEventListener('change', function() {
                    var originalValue = input.getAttribute('data-original-value');
                    if (originalValue !== input.value) {
                        input.value = originalValue;
                    }
                    updateTotal();
                });
            });
            updateTotal();
        });


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
            input.setAttribute('class', 'form-control mt-1 uraian-input');
            input.setAttribute('name', 'uraian_kegiatan_jumlah[]');
            input.setAttribute('placeholder', 'Jumlah');
            input.setAttribute('oninput', 'formatRupiah(this)');
            input.addEventListener('input', updateTotal);

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

            // Hitung total saat menambahkan kolom baru
            // updateTotal();
        }

        function removeUraianColumn(button) {
            var uraianRow = button.closest('.uraian-row');
            uraianRow.remove();

            // Hitung ulang total saat menghapus kolom
            updateTotal();
        }

        function updateTotal() {
            var total = 0;
            var inputs = document.querySelectorAll('.uraian-input');
            inputs.forEach(function(input) {
                var value = input.value.replace(/\D/g, ''); // Menghapus karakter non-digit
                if (value !== '') {
                    total += parseInt(value);
                }
            });

            var totalInput = document.getElementById('total');
            totalInput.value = formatCurrency(total);
        }

        function formatCurrency(amount) {
            return 'Rp ' + amount.toLocaleString('id-ID');
        }


        $(".getPengajuanById").on("change", function() {
            getDataPengajuan();
        });

        function getDataPengajuan() {
            var selectedPengajuanId = $(".getPengajuanById").val();

            $("#pengajuanDetails").hide();

            if (selectedPengajuanId !== "") {
                $.ajax({
                    type: 'GET',
                    url: '/bukti-bp-pengeluaran/getDataPengajuan/' + selectedPengajuanId,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content'),
                        // "Authorization": "Bearer " + parsedObj.token.access_token
                    },
                    dataType: 'json',
                    success: function(responseData) {
                        // var dataPengajuan = json.data;
                        var dataPengajuan = responseData.dataPengajuan;
                        // console.log('disini');
                        // console.log(dataPengajuan);

                        $("#pengajuanDetails").show();

                        $("#pengajuan").val(dataPengajuan.pengajuan.id_pengajuan);
                        $("#nd_nama_kegiatan").val(dataPengajuan.notaDinas.nd_nama_kegiatan);
                        $("#nd_sub_kegiatan").val(dataPengajuan.notaDinas.nd_sub_kegiatan);
                        $("#nd_nomor_nota").val(dataPengajuan.notaDinas.nd_nomor_nota);
                        $("#nd_tanggal").val(dataPengajuan.notaDinas.nd_tanggal);
                        $("#nd_jumlah_biaya").val(dataPengajuan.notaDinas.nd_jumlah_biaya);
                    },
                    error: function(error) {
                        console.error('Error fetching data for Pengajuan:', error);
                    }
                });
            }
        }
    </script>
@endsection
