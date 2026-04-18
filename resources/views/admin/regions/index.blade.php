@extends('admin.layouts.app')

@section('page_title', 'Kelola Foto Daerah')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Foto Daerah</h5>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                <i class="bx bx-plus me-1"></i> Tambah Foto
            </button>
        </div>
        <div class="table-responsive text-nowrap p-3">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Daerah</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($photos as $index => $photo)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td><strong>{{ $photo->name }}</strong></td>
                            <td>
                                <img src="{{ asset('storage/regions/' . $photo->image_path) }}" alt="{{ $photo->name }}"
                                    style="width: 100px; border-radius: 8px;">
                            </td>

                            <td>
                                <button type="button" class="btn btn-sm btn-info btn-edit" data-bs-toggle="modal"
                                    data-bs-target="#editModal" data-id="{{ $photo->id }}"
                                    data-name="{{ $photo->name }}"
                                    data-image="{{ asset('storage/regions/' . $photo->image_path) }}">
                                    <i class="bx bx-edit-alt me-1"></i> Edit
                                </button>

                                <form action="{{ route('admin.regions.destroy', $photo->id) }}" method="POST"
                                    class="d-inline-block" onsubmit="return confirm('Yakin ingin menghapus daerah ini?')">
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
                    <h5 class="modal-title">Tambah Foto Daerah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.regions.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col mb-0">
                                <label for="name" class="form-label">Nama Daerah</label>
                                <input type="text" id="name" name="name" class="form-control"
                                    placeholder="Contoh: Jakarta" required>
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col mb-0">
                                <label for="image" class="form-label">Foto</label>
                                <input type="file" id="image" name="image" class="form-control" accept="image/*"
                                    required>
                                <div class="form-text">Format: JPG, PNG, WEBP (Max 2MB).</div>
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
                    <h5 class="modal-title">Edit Foto Daerah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col mb-0">
                                <label for="edit_name" class="form-label">Nama Daerah</label>
                                <input type="text" id="edit_name" name="name" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col mb-0 text-center">
                                <label class="form-label d-block text-start">Foto Saat Ini</label>
                                <img id="current_image" src="" alt="Preview" class="img-thumbnail"
                                    style="max-height: 150px;">
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col mb-0">
                                <label for="edit_image" class="form-label">Ganti Foto</label>
                                <input type="file" id="edit_image" name="image" class="form-control"
                                    accept="image/*">
                                <div class="form-text">Biarkan kosong jika tidak ingin mengubah foto.</div>
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
        document.addEventListener('DOMContentLoaded', function() {
            // Tangkap elemen modal edit
            var editModal = document.getElementById('editModal');

            // Tambahkan event listener saat modal akan ditampilkan (event bawaan Bootstrap 5)
            if (editModal) {
                editModal.addEventListener('show.bs.modal', function(event) {
                    // Tombol yang memicu modal
                    var button = event.relatedTarget;

                    // Ambil data dari atribut data-* di tombol
                    var id = button.getAttribute('data-id');
                    var name = button.getAttribute('data-name');
                    var imageUrl = button.getAttribute('data-image');

                    // Tangkap elemen inputan di dalam modal
                    var inputName = editModal.querySelector('#edit_name');
                    var imgPreview = editModal.querySelector('#current_image');
                    var form = editModal.querySelector('#editForm');

                    // Masukkan data ke inputan
                    inputName.value = name;
                    imgPreview.src = imageUrl;

                    // Buat URL action form secara dinamis
                    var updateUrl = "{{ route('admin.regions.update', ':id') }}";
                    updateUrl = updateUrl.replace(':id', id);

                    // Set action pada form
                    form.setAttribute('action', updateUrl);
                });
            }
        });
    </script>
@endpush
