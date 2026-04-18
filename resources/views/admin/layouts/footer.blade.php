<footer class="content-footer footer bg-footer-theme">
    {{-- <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
        <div class="mb-2 mb-md-0">
            ©
            <script>
                document.write(new Date().getFullYear())
            </script>
            , dibuat dengan ❤️
        </div>
    </div> --}}
</footer>
<script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
<script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('assets/vendor/js/menu.js') }}"></script>

<script src="{{ asset('assets/js/main.js') }}"></script>

<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 3000
        });
    @endif

    // Alert Error
    @if (session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '{{ session('error') }}',
            confirmButtonText: 'Tutup',
            customClass: {
                confirmButton: 'btn btn-primary'
            },
            buttonsStyling: false
        });
    @endif

    $(document).ready(function() {
        $('table.table:not(.no-datatables)').DataTable({
            info: false,
            lengthChange: false,
            language: {
                search: "Cari:",
                zeroRecords: "Data tidak ditemukan",
                emptyTable: "Tidak ada data yang tersedia di tabel",
                paginate: {
                    previous: "<i class='bx bx-chevron-left'></i>",
                    next: "<i class='bx bx-chevron-right'></i>"
                }
            }
        });
    });
</script>

@stack('page-script')
