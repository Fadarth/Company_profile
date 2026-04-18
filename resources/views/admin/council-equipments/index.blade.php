@extends('admin.layouts.app')

@section('page_title', 'Kelola Alat Kelengkapan Dewan')

@section('content')

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Alat Kelengkapan Dewan</h5>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                <i class="bx bx-plus me-1"></i> Tambah Alat Kelengkapan
            </button>
        </div>
        <div class="table-responsive text-nowrap p-3">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Urutan</th>
                        <th>Nama</th>
                        <th>Class Icon</th>
                        <th>Preview Icon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($equipments as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><span class="badge bg-label-info">{{ $item->rank }}</span></td>
                            <td><strong>{{ $item->name }}</strong></td>
                            <td><code>{{ $item->icon_class }}</code></td>
                            <td><i class="{{ $item->icon_class }} fs-4 text-primary"></i></td>
                            <td>
                                <button type="button" class="btn btn-sm btn-info btn-edit" data-bs-toggle="modal"
                                    data-bs-target="#editModal" data-id="{{ $item->id }}"
                                    data-name="{{ $item->name }}" data-icon="{{ $item->icon_class }}"
                                    data-rank="{{ $item->rank }}" data-task_scope="{{ $item->task_scope }}"
                                    data-work_partners="{{ $item->work_partners }}">
                                    <i class="bx bx-edit-alt me-1"></i> Edit
                                </button>

                                <form action="{{ route('admin.council-equipments.destroy', $item->id) }}" method="POST"
                                    class="d-inline-block"
                                    onsubmit="return confirm('Yakin ingin menghapus alat kelengkapan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="bx bx-trash me-1"></i> Hapus
                                    </button>
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
                    <h5 class="modal-title">Tambah Alat Kelengkapan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.council-equipments.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" id="name" name="name" class="form-control"
                                    placeholder="Contoh: Komisi I" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="icon_class" class="form-label">Class Icon</label>
                                <input type="text" id="icon_class" name="icon_class" class="form-control"
                                    placeholder="Contoh: bx bxs-group" required>
                                <small class="text-muted">Masukkan class icon dari Boxicons atau FontAwesome.</small>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label for="rank" class="form-label">Urutan Tampil</label>
                                <input type="number" id="rank" name="rank" class="form-control"
                                    placeholder="Contoh: 1" required min="1">
                                <small class="text-muted">Angka lebih kecil akan tampil lebih dulu di halaman
                                    landing.</small>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="task_scope" class="form-label">Ruang Lingkup Tugas</label>
                                <textarea id="task_scope" name="task_scope" class="form-control" rows="4"
                                    placeholder="Pertahanan&#10;Luar Negeri&#10;Informatika"></textarea>
                                {{-- <small class="text-info mt-1 d-block">
                                    <i class="bx bx-info-circle"></i> Tekan <strong>Enter</strong> untuk memisahkan setiap
                                    poin. (Satu baris = satu poin).
                                </small> --}}
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="work_partners" class="form-label">Mitra Kerja</label>
                                <textarea id="work_partners" name="work_partners" class="form-control" rows="4"
                                    placeholder="Kementerian Luar Negeri&#10;Kementerian Pertahanan&#10;Badan Intelijen Negara (BIN)"></textarea>
                                {{-- <small class="text-info mt-1 d-block">
                                    <i class="bx bx-info-circle"></i> Tekan <strong>Enter</strong> untuk memisahkan setiap
                                    poin.
                                </small> --}}
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
                    <h5 class="modal-title">Edit Alat Kelengkapan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col">
                                <label for="edit_name" class="form-label">Nama</label>
                                <input type="text" id="edit_name" name="name" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="edit_icon_class" class="form-label">Class Icon</label>
                                <input type="text" id="edit_icon_class" name="icon_class" class="form-control"
                                    required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="edit_rank" class="form-label">Urutan Tampil (Rank)</label>
                                <input type="number" id="edit_rank" name="rank" class="form-control" required
                                    min="1">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="edit_task_scope" class="form-label">Ruang Lingkup Tugas</label>
                                <textarea id="edit_task_scope" name="task_scope" class="form-control" rows="4"></textarea>
                                {{-- <small class="text-info mt-1 d-block">Tekan <strong>Enter</strong> untuk memisahkan setiap
                                    poin.</small> --}}
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="edit_work_partners" class="form-label">Mitra Kerja</label>
                                <textarea id="edit_work_partners" name="work_partners" class="form-control" rows="4"></textarea>
                                {{-- <small class="text-info mt-1 d-block">Tekan <strong>Enter</strong> untuk memisahkan setiap
                                    poin.</small> --}}
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
            $('.btn-edit').on('click', function() {
                let id = $(this).data('id');

                // Isi nilai ke dalam form edit
                $('#edit_name').val($(this).data('name'));
                $('#edit_icon_class').val($(this).data('icon'));
                $('#edit_rank').val($(this).data('rank'));
                $('#edit_task_scope').val($(this).data('task_scope'));
                $('#edit_work_partners').val($(this).data('work_partners'));

                // Mengganti :id pada URL route dengan id yang diklik
                let updateUrl = "{{ route('admin.council-equipments.update', ':id') }}";
                updateUrl = updateUrl.replace(':id', id);
                $('#editForm').attr('action', updateUrl);
            });
        });
    </script>
@endpush
