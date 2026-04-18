@extends('admin.layouts.app')

@section('page_title', 'Kelola Data Organisasi')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Dokumen Organisasi</h5>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                <i class="bx bx-plus me-1"></i> Tambah Dokumen
            </button>
        </div>
        <div class="table-responsive text-nowrap p-3">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul Dokumen</th>
                        <th>File PDF</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($organizations as $index => $org)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td><strong>{{ $org->title }}</strong></td>
                            <td>
                                <a href="{{ asset('storage/' . $org->file_path) }}" target="_blank"
                                    class="btn btn-sm btn-outline-primary">
                                    <i class="bx bx-file me-1"></i> Lihat PDF
                                </a>
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-info btn-edit" data-bs-toggle="modal"
                                    data-bs-target="#editModal" data-id="{{ $org->id }}"
                                    data-title="{{ $org->title }}"
                                    data-file-url="{{ asset('storage/' . $org->file_path) }}"
                                    data-file-name="{{ basename($org->file_path) }}">
                                    <i class="bx bx-edit-alt me-1"></i> Edit
                                </button>

                                <form action="{{ route('admin.organizations.destroy', $org->id) }}" method="POST"
                                    class="d-inline-block" onsubmit="return confirm('Yakin ingin menghapus dokumen ini?')">
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
                    <h5 class="modal-title">Tambah Dokumen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.organizations.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col">
                                <label for="title" class="form-label">Judul Dokumen</label>
                                <input type="text" id="title" name="title" class="form-control"
                                    placeholder="Contoh: Data Fraksi-Fraksi" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="file" class="form-label">File PDF</label>
                                <input type="file" id="file" name="file" class="form-control"
                                    accept="application/pdf" required>
                                <div class="form-text">Hanya menerima format .PDF (Maksimal 5MB).</div>
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
                    <h5 class="modal-title">Edit Dokumen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col">
                                <label for="edit_title" class="form-label">Judul Dokumen</label>
                                <input type="text" id="edit_title" name="title" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="edit_file" class="form-label">Ganti File PDF</label>

                                <div class="mb-2" id="current_file_container" style="display: none;">
                                    <span class="text-muted d-block mb-1" style="font-size: 0.85rem;">File saat
                                        ini:</span>
                                    <a href="#" id="current_file_link" target="_blank"
                                        class="btn btn-sm btn-outline-primary mb-2">
                                        <i class="bx bx-file me-1"></i> <span id="current_file_name">nama_file.pdf</span>
                                    </a>
                                </div>
                                <input type="file" id="edit_file" name="file" class="form-control"
                                    accept="application/pdf">
                                <div class="form-text">Biarkan kosong jika tidak ingin mengganti file PDF.</div>
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
            $(document).on('click', '.btn-edit', function() {
                let id = $(this).data('id');
                $('#edit_title').val($(this).data('title'));

                // Tangkap data file
                let fileUrl = $(this).data('file-url');
                let fileName = $(this).data('file-name');

                // Tampilkan info file jika ada
                if (fileUrl && fileName) {
                    $('#current_file_link').attr('href', fileUrl);
                    $('#current_file_name').text(fileName);
                    $('#current_file_container').show();
                } else {
                    $('#current_file_container').hide();
                }

                // Ubah action URL form
                let updateUrl = "{{ route('admin.organizations.update', ':id') }}";
                updateUrl = updateUrl.replace(':id', id);
                $('#editForm').attr('action', updateUrl);
            });
        });
    </script>
@endpush
