@extends('admin.layouts.app')

@section('page_title', 'Statistik & Analitik Website')

@section('content')
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="card-info">
                            <p class="card-text text-muted mb-1">Pengunjung Hari Ini</p>
                            <div class="d-flex align-items-end mb-2">
                                <h4 class="card-title mb-0 me-2">{{ $visitorsToday }}</h4>
                            </div>
                        </div>
                        <div class="card-icon">
                            <span class="badge bg-label-primary rounded p-2">
                                <i class="bx bx-user bx-sm"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="card-info">
                            <p class="card-text text-muted mb-1">Pengunjung Minggu Ini</p>
                            <div class="d-flex align-items-end mb-2">
                                <h4 class="card-title mb-0 me-2">{{ $visitorsThisWeek }}</h4>
                            </div>
                        </div>
                        <div class="card-icon">
                            <span class="badge bg-label-success rounded p-2">
                                <i class="bx bx-calendar-week bx-sm"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="card-info">
                            <p class="card-text text-muted mb-1">Pengunjung Tahun Ini</p>
                            <div class="d-flex align-items-end mb-2">
                                <h4 class="card-title mb-0 me-2">{{ $visitorsThisYear }}</h4>
                            </div>
                        </div>
                        <div class="card-icon">
                            <span class="badge bg-label-warning rounded p-2">
                                <i class="bx bx-calendar bx-sm"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="card-info">
                            <p class="card-text text-muted mb-1">Total Keseluruhan</p>
                            <div class="d-flex align-items-end mb-2">
                                <h4 class="card-title mb-0 me-2">{{ $totalVisitors }}</h4>
                            </div>
                        </div>
                        <div class="card-icon">
                            <span class="badge bg-label-info rounded p-2">
                                <i class="bx bx-bar-chart-alt-2 bx-sm"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Peringkat Berita Terpopuler</h5>
        </div>
        <div class="table-responsive text-nowrap p-3 pt-0">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="15%">Gambar</th>
                        <th>Judul Berita</th>
                        <th>Kategori</th>
                        <th>Tgl Publish</th>
                        <th>Total Dilihat</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($newsList as $index => $news)
                        <tr>
                            <td><strong>{{ $index + 1 }}</strong></td>
                            <td>
                                <img src="{{ asset('storage/' . $news->image_path) }}" alt="Img"
                                    style="width: 80px; border-radius: 8px; object-fit: cover;">
                            </td>
                            <td>
                                <strong>{{ $news->title }}</strong>
                            </td>
                            <td><span class="badge bg-label-info">{{ $news->category }}</span></td>
                            <td>{{ \Carbon\Carbon::parse($news->published_date)->format('d M Y') }}</td>
                            <td>
                                <span class="badge bg-primary">
                                    <i class="bx bx-show me-1"></i> {{ $news->views_count }} Kali
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">Belum ada data berita.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
