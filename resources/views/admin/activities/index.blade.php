@extends('admin.layouts.app')

@section('page_title', 'Kelola Kegiatan')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Kegiatan</h5>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                <i class="bx bx-plus me-1"></i> Tambah Kegiatan
            </button>
        </div>
        <div class="table-responsive text-nowrap p-3">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kegiatan</th>
                        <th>Tanggal</th>
                        <th>Waktu</th>
                        <th>Lokasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($activities as $index => $activity)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td><strong>{{ $activity->title }}</strong></td>
                            <td>
                                {{ $activity->start_date }}
                                @if ($activity->end_date)
                                    <br>
                                    <small class="text-muted">s/d {{ $activity->end_date }}</small>
                                @endif
                            </td>
                            <td>{{ $activity->time }}</td>
                            <td>{{ $activity->location }}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-info btn-edit" data-bs-toggle="modal"
                                    data-bs-target="#editModal" data-id="{{ $activity->id }}"
                                    data-title="{{ $activity->title }}" data-start-date="{{ $activity->start_date }}"
                                    data-end-date="{{ $activity->end_date }}" data-time="{{ $activity->time }}"
                                    data-location="{{ $activity->location }}">
                                    <i class="bx bx-edit-alt me-1"></i> Edit
                                </button>

                                <form action="{{ route('admin.activities.destroy', $activity->id) }}" method="POST"
                                    class="d-inline-block" onsubmit="return confirm('Yakin ingin menghapus kegiatan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="bx bx-trash me-1"></i>
                                        Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Kegiatan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.activities.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col">
                                <label for="title" class="form-label">Nama Kegiatan</label>
                                <input type="text" id="title" name="title" class="form-control" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="start_date" class="form-label">Tanggal Mulai</label>
                                <input type="date" id="start_date" name="start_date" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label for="end_date" class="form-label">Tanggal Selesai <span
                                        class="text-muted">(Opsional)</span></label>
                                <input type="date" id="end_date" name="end_date" class="form-control">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3 mb-md-0">
                                <label for="time" class="form-label">Waktu</label>
                                <input type="time" id="time" name="time" class="form-control" required>
                            </div>
                            <div class="col-md-8">
                                <label for="location" class="form-label">Lokasi</label>
                                <input type="text" id="location" name="location" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Kegiatan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col">
                                <label for="edit_title" class="form-label">Nama Kegiatan</label>
                                <input type="text" id="edit_title" name="title" class="form-control" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="edit_start_date" class="form-label">Tanggal Mulai</label>
                                <input type="date" id="edit_start_date" name="start_date" class="form-control"
                                    required>
                            </div>
                            <div class="col-md-6">
                                <label for="edit_end_date" class="form-label">Tanggal Selesai <span
                                        class="text-muted">(Opsional)</span></label>
                                <input type="date" id="edit_end_date" name="end_date" class="form-control">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3 mb-md-0">
                                <label for="edit_time" class="form-label">Waktu</label>
                                <input type="time" id="edit_time" name="time" class="form-control" required>
                            </div>
                            <div class="col-md-8">
                                <label for="edit_location" class="form-label">Lokasi</label>
                                <input type="text" id="edit_location" name="location" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Perbarui</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('page-script')
    <script>
        $(document).ready(function() {
            // Gunakan document.on seperti sebelumnya
            $(document).on('click', '.btn-edit', function() {
                let id = $(this).data('id');

                $('#edit_title').val($(this).data('title'));

                // Sekarang data ini akan terbaca dengan benar
                $('#edit_start_date').val($(this).data('start-date'));
                $('#edit_end_date').val($(this).data('end-date'));

                $('#edit_time').val($(this).data('time'));
                $('#edit_location').val($(this).data('location'));

                // Ubah action form sesuai ID kegiatan
                let updateUrl = "{{ route('admin.activities.update', ':id') }}";
                updateUrl = updateUrl.replace(':id', id);
                $('#editForm').attr('action', updateUrl);
            });
        });
    </script>
@endpush
