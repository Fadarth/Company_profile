<?php

namespace App\Services;

use App\Models\Aspiration;
use App\Models\News;
use App\Models\CouncilMember;
use App\Models\Activity;
use App\Models\RegionPhoto; // Tambahan
use App\Models\OrganizationData; // Tambahan
use Carbon\Carbon;

class DashboardService
{
    public function getDashboardData()
    {
        // 1. Ambil data untuk Card Statistik
        $data['totalAspirasi'] = Aspiration::count();

        // Menghitung aspirasi yang masuk di bulan dan tahun saat ini
        $data['aspirasiBaru'] = Aspiration::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();

        $data['totalBerita'] = News::count();
        $data['totalAnggota'] = CouncilMember::count();
        $data['totalKegiatan'] = Activity::count();

        // --- TAMBAHAN BARU ---
        $data['totalDaerah'] = RegionPhoto::count();
        $data['totalDokumen'] = OrganizationData::count();
        $data['recentNews'] = News::latest()->take(4)->get();
        // ---------------------

        // 2. Ambil 5 aspirasi terbaru untuk list mini di sebelah kanan
        $data['recentAspirations'] = Aspiration::latest()->take(5)->get();

        // 3. Generate data untuk grafik garis (7 Bulan Terakhir)
        $chartLabels = [];
        $chartData = [];

        // Looping mundur dari 6 bulan yang lalu sampai bulan ini (0)
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);

            // Nama bulan (Contoh: Apr 26)
            $chartLabels[] = $date->translatedFormat('M y');

            // Hitung aspirasi per bulan tersebut
            $chartData[] = Aspiration::whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)
                ->count();
        }

        $data['chartLabels'] = $chartLabels;
        $data['chartData'] = $chartData;

        return $data;
    }
}