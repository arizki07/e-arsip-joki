<!-- Alerts Unutuk menampilkan pemberitahuan sukses/gagal -->
@if (session()->get('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: "{{ session()->get('error') }}",
                showConfirmButton: true,
            });
        });
    </script>
@endif


@if (session()->get('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: "{{ session()->get('success') }}",
                showConfirmButton: true
            });
        });
    </script>
@endif

@if (count($errors) > 0)
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var errorMessages = @json($errors->all());

            for (var i = 0; i < errorMessages.length; i++) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: errorMessages[i],
                    showConfirmButton: true
                });
            }
        });
    </script>
@endif

{{-- @foreach ($biodata as $item) --}}
<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Hapus Data {{ $title }}',
            text: 'Apakah anda yakin ingin menghapus data ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit the corresponding form
                document.getElementById('deleteForm' + id).submit();
            }
        });
    }
</script>
{{-- @endforeach --}}



<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

<style>
    .alert-fade {
        transition: opacity 0.5s ease-out;
    }

    .fade-out {
        opacity: 0;
        transition: opacity 0.5s ease-out;
    }
</style>
<!-- End Alert -->
