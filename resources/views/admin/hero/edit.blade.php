@extends('admin.layouts.app')

@section('page_title', 'Edit Beranda')

@section('content')
    <div class="row">
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Pengaturan Bagian Beranda</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.hero.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="title">Judul (Title)</label>
                            <div class="col-sm-10">
                                <textarea id="title" name="title" class="form-control" rows="3" required>{{ old('title', $hero->title) }}</textarea>
                                <div class="form-text">Anda bisa menggunakan tag HTML untuk memberi warna atau baris baru.
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="image">Gambar Beranda</label>
                            <div class="col-sm-10">
                                @if ($hero->image_path)
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/hero/' . $hero->image_path) }}" alt="Hero Image"
                                            class="img-thumbnail" style="max-height: 200px;">
                                    </div>
                                @endif
                                <input class="form-control" type="file" id="image" name="image" accept="image/*" />
                                <div class="form-text">Biarkan kosong jika tidak ingin mengubah gambar. Format: JPG, PNG,
                                    WEBP (Max 2MB).</div>
                            </div>
                        </div>

                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
