@extends('admin.layouts.app')

@section('page_title', 'Kelola Aspirasi Masyarakat')

@section('content')

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Daftar Aspirasi Masyarakat</h5>
        </div>
        <div class="table-responsive text-nowrap p-3">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Pengirim</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Tampil di Landing</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($aspirations as $item)
                        <tr>
                            <td>{{ $item->created_at->format('d M Y') }}</td>
                            <td>
                                <strong>{{ $item->name }}</strong><br>
                                <small class="text-muted">{{ $item->contact ?? '-' }}</small>
                            </td>
                            <td>{{ $item->category }}</td>
                            <td>
                                @if ($item->status == 'dalam_proses')
                                    <span class="badge bg-warning">Dalam Proses</span>
                                @elseif($item->status == 'ditindaklanjuti')
                                    <span class="badge bg-info">Ditindaklanjuti</span>
                                @else
                                    <span class="badge bg-success">Selesai</span>
                                @endif
                            </td>
                            <td>
                                @if ($item->is_published)
                                    <span class="badge bg-label-success">Ya</span>
                                @else
                                    <span class="badge bg-label-danger">Tidak</span>
                                @endif
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-info btn-edit" data-bs-toggle="modal"
                                    data-bs-target="#editModal" data-id="{{ $item->id }}"
                                    data-status="{{ $item->status }}" data-published="{{ $item->is_published }}"
                                    data-message="{{ $item->message }}">
                                    <i class="bx bx-check-shield me-1"></i> Tindakan
                                </button>

                                <form action="{{ route('admin.aspirations.destroy', $item->id) }}" method="POST"
                                    class="d-inline-block" onsubmit="return confirm('Yakin ingin menghapus aspirasi ini?')">
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

    <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tindak Lanjut Aspirasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Isi Aspirasi</label>
                            <textarea id="view_message" class="form-control" rows="4" readonly></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="edit_status" class="form-label">Ubah Status</label>
                            <select id="edit_status" name="status" class="form-select" required>
                                <option value="dalam_proses">Dalam Proses</option>
                                <option value="ditindaklanjuti">Ditindaklanjuti</option>
                                <option value="selesai">Selesai</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit_published" class="form-label">Tampilkan di Landing Page?</label>
                            <select id="edit_published" name="is_published" class="form-select" required>
                                <option value="1">Ya, Tampilkan</option>
                                <option value="0">Tidak, Sembunyikan</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('page-script')
    <script>
        $(document).ready(function() {
            // Gunakan document.on agar tombol di dalam tabel tetap terbaca event klik-nya
            $(document).on('click', '.btn-edit', function() {
                let id = $(this).data('id');

                // Masukkan data ke dalam modal
                $('#view_message').val($(this).data('message'));
                $('#edit_status').val($(this).data('status'));
                $('#edit_published').val($(this).data('published') ? 1 : 0);

                // Ubah action URL form sesuai ID aspirasi
                let updateUrl = "{{ route('admin.aspirations.update', ':id') }}";
                updateUrl = updateUrl.replace(':id', id);
                $('#editForm').attr('action', updateUrl);
            });
        });
    </script>
@endpush
