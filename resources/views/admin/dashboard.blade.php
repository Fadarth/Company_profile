@extends('admin.layouts.app')

@section('page_title', 'Dashboard Utama')

@section('content')
    <div class="row">
        <div class="col-12 mb-4">
            <div class="card bg-transparent border-0 shadow-none">
                <div class="card-body p-0">
                    <h4 class="fw-bold mb-1">Selamat datang kembali, Admin! 👋</h4>
                    <p class="text-muted">Berikut adalah ringkasan data dan aktivitas terbaru hari ini.</p>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="card-info">
                            <p class="card-text text-muted mb-1">Total Aspirasi</p>
                            <div class="d-flex align-items-end mb-2">
                                <h4 class="card-title mb-0 me-2">{{ $totalAspirasi }}</h4>
                                <small class="text-success">(+{{ $aspirasiBaru }} bulan ini)</small>
                            </div>
                        </div>
                        <div class="card-icon">
                            <span class="badge bg-label-primary rounded p-2">
                                <i class="bx bx-message-square-detail bx-sm"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="card-info">
                            <p class="card-text text-muted mb-1">Berita & Agenda</p>
                            <div class="d-flex align-items-end mb-2">
                                <h4 class="card-title mb-0 me-2">{{ $totalBerita }}</h4>
                            </div>
                        </div>
                        <div class="card-icon">
                            <span class="badge bg-label-info rounded p-2">
                                <i class="bx bx-news bx-sm"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="card-info">
                            <p class="card-text text-muted mb-1">Anggota Dewan</p>
                            <div class="d-flex align-items-end mb-2">
                                <h4 class="card-title mb-0 me-2">{{ $totalAnggota }}</h4>
                            </div>
                        </div>
                        <div class="card-icon">
                            <span class="badge bg-label-warning rounded p-2">
                                <i class="bx bx-group bx-sm"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="card-info">
                            <p class="card-text text-muted mb-1">Kegiatan & Dokumen</p>
                            <div class="d-flex align-items-end mb-2">
                                <h4 class="card-title mb-0 me-2">{{ $totalKegiatan + $totalDokumen }}</h4>
                            </div>
                        </div>
                        <div class="card-icon">
                            <span class="badge bg-label-success rounded p-2">
                                <i class="bx bx-folder-open bx-sm"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0 fw-bold">Aspirasi Terbaru</h5>
                    <a href="#" class="badge bg-label-primary">Lihat Semua</a>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        @forelse($recentAspirations as $aspirasi)
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0 pb-3">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="avatar flex-shrink-0">
                                        <span class="avatar-initial rounded-circle bg-label-dark"><i
                                                class="bx bx-user"></i></span>
                                    </div>
                                    <div>
                                        <h6 class="mb-0 fw-semibold">{{ $aspirasi->name }}</h6>
                                        <small class="text-muted">{{ $aspirasi->category }}</small>
                                    </div>
                                </div>
                                @if ($aspirasi->status == 'dalam_proses')
                                    <span class="badge bg-warning rounded-pill px-2">Baru</span>
                                @elseif($aspirasi->status == 'ditindaklanjuti')
                                    <span class="badge bg-info rounded-pill px-2">Proses</span>
                                @else
                                    <span class="badge bg-success rounded-pill px-2">Selesai</span>
                                @endif
                            </li>
                        @empty
                            <li class="list-group-item text-center text-muted border-0 pb-3 mt-3">
                                Belum ada aspirasi yang masuk.
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-lg-8 col-md-12 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0 fw-bold">Statistik Aspirasi Masuk</h5>
                    <small class="text-muted">7 Bulan Terakhir</small>
                </div>
                <div class="card-body">
                    <div id="aestheticChart" style="min-height: 300px;"></div>
                </div>
            </div>
        </div>

        <div class="col-12 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0 fw-bold">Berita Terkini Diterbitkan</h5>
                    <a href="{{ route('admin.news.index') }}" class="btn btn-sm btn-outline-primary">Kelola Berita</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        @forelse($recentNews as $news)
                            <div class="col-md-3 col-sm-6 mb-3">
                                <div class="card h-100 border shadow-none">
                                    <img class="card-img-top" src="{{ asset($news->image_path) }}" alt="{{ $news->title }}"
                                        style="height: 120px; object-fit: cover;">
                                    <div class="card-body p-3">
                                        <span class="badge bg-label-warning mb-2">{{ $news->category }}</span>
                                        <h6 class="card-title mb-1 text-truncate" title="{{ $news->title }}">
                                            {{ $news->title }}</h6>
                                        <small class="text-muted">{{ $news->formatted_date }}</small>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-center text-muted mt-3">
                                Belum ada berita yang diterbitkan.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page-script')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Mengambil data dari PHP ke JavaScript
            const chartLabels = @json($chartLabels);
            const chartData = @json($chartData);

            // Konfigurasi ApexCharts (Estetik & Smooth)
            const options = {
                series: [{
                    name: 'Jumlah Aspirasi',
                    data: chartData
                }],
                chart: {
                    height: 320,
                    type: 'area', // Ini yang membuat background di bawah garis
                    parentHeightOffset: 0,
                    toolbar: {
                        show: false
                    },
                    zoom: {
                        enabled: false
                    }
                },
                colors: ['#ffab00'], // Warna Oranye sesuai request
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth', // Lengkungan garis halus
                    width: 3
                },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.6, // Transparansi atas
                        opacityTo: 0.05, // Transparansi bawah (memudar)
                        stops: [0, 90, 100]
                    }
                },
                xaxis: {
                    categories: chartLabels,
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    },
                    labels: {
                        style: {
                            colors: '#a1acb8',
                            fontSize: '13px'
                        }
                    }
                },
                yaxis: {
                    labels: {
                        style: {
                            colors: '#a1acb8',
                            fontSize: '13px'
                        }
                    }
                },
                grid: {
                    borderColor: '#e8eaed',
                    strokeDashArray: 4, // Garis putus-putus pembatas di background
                    padding: {
                        top: -20,
                        bottom: -10,
                        left: -10,
                        right: 0
                    }
                },
                tooltip: {
                    theme: 'light',
                    y: {
                        formatter: function(val) {
                            return val + " Laporan"
                        }
                    }
                }
            };

            const chart = new ApexCharts(document.querySelector("#aestheticChart"), options);
            chart.render();
        });
    </script>
@endpush
