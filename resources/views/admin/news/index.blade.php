@extends('admin.layouts.app')

@section('page_title', 'Kelola Berita')

@push('vendor-style')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endpush

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Berita</h5>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                <i class="bx bx-plus me-1"></i> Tambah Berita
            </button>
        </div>
        <div class="table-responsive text-nowrap p-3">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Tgl Publish</th>
                        <th>Gambar</th>
                        <th>Judul Berita</th>
                        <th>Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($newsList as $news)
                        <tr>
                            <td>{{ $news->formatted_date }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $news->image_path) }}" alt="Img"
                                    style="width: 80px; border-radius: 8px;">
                            </td>
                            <td><strong>{{ $news->title }}</strong></td>
                            <td><span class="badge bg-label-info">{{ $news->category }}</span></td>
                            <td>
                                <div id="desc-{{ $news->id }}" class="d-none">{!! $news->description !!}</div>

                                <button type="button" class="btn btn-sm btn-info btn-edit" data-bs-toggle="modal"
                                    data-bs-target="#editModal" data-id="{{ $news->id }}"
                                    data-title="{{ $news->title }}" data-category="{{ $news->category }}"
                                    data-date="{{ $news->published_date }}"
                                    data-image="{{ asset('storage/' . $news->image_path) }}">
                                    <i class="bx bx-edit-alt me-1"></i> Edit
                                </button>

                                <form action="{{ route('admin.news.destroy', $news->id) }}" method="POST"
                                    class="d-inline-block" onsubmit="return confirm('Hapus berita ini?')">
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
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Berita</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form_create" action="{{ route('admin.news.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-md-8">
                                <label class="form-label">Judul Berita</label>
                                <input type="text" name="title" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Kategori</label>
                                <input type="text" name="category" class="form-control" placeholder="Contoh: Legislasi"
                                    required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Tanggal Publish</label>
                                <input type="date" name="published_date" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Gambar Sampul</label>
                                <input type="file" name="image" class="form-control" accept="image/*" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label class="form-label">Isi Berita</label>
                                <div id="editor-create" style="height: 250px;"></div>
                                <input type="hidden" name="description" id="hidden_desc_create">
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
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Berita</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form_edit" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-md-8">
                                <label class="form-label">Judul Berita</label>
                                <input type="text" id="edit_title" name="title" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Kategori</label>
                                <input type="text" id="edit_category" name="category" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Tanggal Publish</label>
                                <input type="date" id="edit_date" name="published_date" class="form-control"
                                    required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Ganti Gambar (Opsional)</label>
                                <div class="mb-2">
                                    <img id="preview_image" src="" alt="Preview"
                                        style="max-width: 150px; border-radius: 8px; display: none;">
                                </div>
                                <input type="file" name="image" id="edit_image_input" class="form-control"
                                    accept="image/*">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label class="form-label">Isi Berita</label>
                                <div id="editor-edit" style="height: 250px;"></div>
                                <input type="hidden" name="description" id="hidden_desc_edit">
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
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <script>
        $(document).ready(function() {
            var quillCreate = new Quill('#editor-create', {
                theme: 'snow',
                placeholder: 'Tulis isi berita di sini...'
            });

            var quillEdit = new Quill('#editor-edit', {
                theme: 'snow'
            });

            $('#form_create').on('submit', function() {
                $('#hidden_desc_create').val(quillCreate.root.innerHTML);
            });

            $('#form_edit').on('submit', function() {
                $('#hidden_desc_edit').val(quillEdit.root.innerHTML);
            });

            $('.btn-edit').on('click', function() {
                let id = $(this).data('id');
                $('#edit_title').val($(this).data('title'));
                $('#edit_category').val($(this).data('category'));
                $('#edit_date').val($(this).data('date'));

                // Set preview gambar lama
                let imageUrl = $(this).data('image');
                if (imageUrl) {
                    $('#preview_image').attr('src', imageUrl).show();
                } else {
                    $('#preview_image').hide();
                }

                // Ambil data HTML dari DIV tersembunyi (agar tidak muncul tag p p)
                let rawDescription = $('#desc-' + id).html();
                // Gunakan fitur paste HTML bawaan Quill
                quillEdit.clipboard.dangerouslyPasteHTML(rawDescription);

                let updateUrl = "{{ route('admin.news.update', ':id') }}";
                updateUrl = updateUrl.replace(':id', id);
                $('#form_edit').attr('action', updateUrl);
            });

            // (Opsional) Preview gambar baru jika diubah di modal edit
            $('#edit_image_input').on('change', function(e) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    $('#preview_image').attr('src', e.target.result).show();
                }
                reader.readAsDataURL(this.files[0]);
            });
        });
    </script>
@endpush
