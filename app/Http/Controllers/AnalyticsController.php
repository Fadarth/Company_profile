<?php

namespace App\Http\Controllers;

use App\Models\News;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    public function analytics()
    {
        // Mengambil rentang waktu
        $today = Carbon::today()->toDateString();
        $startOfWeek = Carbon::now()->startOfWeek()->toDateString();
        $endOfWeek = Carbon::now()->endOfWeek()->toDateString();
        $thisYear = Carbon::now()->year;

        // Menghitung jumlah pengunjung (berdasarkan IP per hari)
        $visitorsToday = DB::table('visitors')->where('visit_date', $today)->count();

        $visitorsThisWeek = DB::table('visitors')
            ->whereBetween('visit_date', [$startOfWeek, $endOfWeek])
            ->count();

        $visitorsThisYear = DB::table('visitors')->whereYear('visit_date', $thisYear)->count();

        $totalVisitors = DB::table('visitors')->count();

        // Mengambil data berita diurutkan dari view terbanyak
        $newsList = News::orderBy('views_count', 'desc')->get();

        return view('admin.analytics.index', compact(
            'visitorsToday',
            'visitorsThisWeek',
            'visitorsThisYear',
            'totalVisitors',
            'newsList'
        ));
    }
}
