@extends('admin.layouts.app')

@section('page_title', 'Kelola Anggota Dewan')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Anggota Dewan</h5>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                <i class="bx bx-plus me-1"></i> Tambah Anggota
            </button>
        </div>
        <div class="table-responsive text-nowrap p-3">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Urutan Tampil</th>
                        <th>Foto</th>
                        <th>Nama Lengkap</th>
                        <th>Jabatan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($members as $member)
                        <tr>
                            <td><span class="badge bg-label-primary">{{ $member->rank }}</span></td>
                            <td>
                                <img src="{{ asset('storage/' . $member->image_path) }}" alt="{{ $member->name }}"
                                    class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
                            </td>
                            <td><strong>{{ $member->name }}</strong></td>
                            <td>{{ $member->position }}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-info btn-edit" data-bs-toggle="modal"
                                    data-bs-target="#editModal" data-id="{{ $member->id }}"
                                    data-name="{{ $member->name }}" data-position="{{ $member->position }}"
                                    data-rank="{{ $member->rank }}"
                                    data-image="{{ asset('storage/' . $member->image_path) }}">
                                    <i class="bx bx-edit-alt me-1"></i> Edit
                                </button>


                                <form action="{{ route('admin.members.destroy', $member->id) }}" method="POST"
                                    class="d-inline-block" onsubmit="return confirm('Yakin ingin menghapus anggota ini?')">
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
                    <h5 class="modal-title">Tambah Anggota Dewan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.members.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col">
                                <label for="name" class="form-label">Nama Lengkap & Gelar</label>
                                <input type="text" id="name" name="name" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-8">
                                <label for="position" class="form-label">Jabatan</label>
                                <input type="text" id="position" name="position" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label for="rank" class="form-label">Prioritas (1-99)</label>
                                <input type="number" id="rank" name="rank" class="form-control" value="99"
                                    required>
                                <small class="text-muted">Makin kecil makin awal</small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="image" class="form-label">Foto Profil</label>
                                <input type="file" id="image" name="image" class="form-control" accept="image/*"
                                    required>
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
                    <h5 class="modal-title">Edit Anggota Dewan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col">
                                <label for="edit_name" class="form-label">Nama Lengkap & Gelar</label>
                                <input type="text" id="edit_name" name="name" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-8">
                                <label for="edit_position" class="form-label">Jabatan</label>
                                <input type="text" id="edit_position" name="position" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label for="edit_rank" class="form-label">Prioritas</label>
                                <input type="number" id="edit_rank" name="rank" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <img id="current_image" src="" alt="Preview"
                                    class="img-thumbnail rounded-circle"
                                    style="width: 80px; height: 80px; object-fit: cover;">
                            </div>
                            <div class="col-md-9 align-self-center">
                                <label for="edit_image" class="form-label">Ganti Foto Profil</label>
                                <input type="file" id="edit_image" name="image" class="form-control"
                                    accept="image/*">
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
        // Pastikan jQuery sudah di-load di layout utama Anda sebelum script ini jalan
        $(document).ready(function() {
            // Gunakan document.on agar tombol yang ter-load belakangan tetap berfungsi
            $(document).on('click', '.btn-edit', function() {
                let id = $(this).data('id');

                // Isi inputan modal
                $('#edit_name').val($(this).data('name'));
                $('#edit_position').val($(this).data('position'));
                $('#edit_rank').val($(this).data('rank'));
                $('#current_image').attr('src', $(this).data('image'));

                // Ubah action form ke route update sesuai ID
                let updateUrl = "{{ route('admin.members.update', ':id') }}";
                updateUrl = updateUrl.replace(':id', id);

                // Set action form
                $('#editForm').attr('action', updateUrl);
            });
        });
    </script>
@endpush
