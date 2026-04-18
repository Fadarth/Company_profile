@extends('admin.layouts.app')

@section('page_title', 'Kelola Struktural Dewan')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Edit Data Struktural Dewan</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.council-structures.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label" for="title">Judul</label>
                            <input type="text" class="form-control" id="title" name="title"
                                value="{{ $structure->title }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="description">Deskripsi Singkat</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required>{{ $structure->description }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="file">File PDF Struktural Dewan</label>
                            @if ($structure->file_path)
                                <div class="mb-2">
                                    <a href="{{ asset('storage/' . $structure->file_path) }}" target="_blank"
                                        class="btn btn-sm btn-outline-primary">
                                        <i class="bx bx-file"></i> Lihat File Saat Ini
                                    </a>
                                </div>
                            @endif
                            <input type="file" class="form-control" id="file" name="file"
                                accept="application/pdf">
                            <div class="form-text">Format wajib .pdf (Maksimal 5MB). Biarkan kosong jika tidak ingin
                                mengubah file.</div>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="bx bx-save me-1"></i> Simpan Perubahan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
