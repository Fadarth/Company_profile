<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Services\NewsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class NewsController extends Controller
{
    protected NewsService $newsService;

    public function __construct(NewsService $newsService)
    {
        $this->newsService = $newsService;
    }

    public function index()
    {
        $newsList = $this->newsService->getAllNews();
        return view('admin.news.index', compact('newsList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'published_date' => 'required|date',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $this->newsService->createNews($request->except('image'), $request->file('image'));

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function update(Request $request, News $news)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'published_date' => 'required|date',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $this->newsService->updateNews($news, $request->except('image'), $request->file('image'));

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(News $news)
    {
        $this->newsService->deleteNews($news);
        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil dihapus.');
    }


    public function trackView($id, Request $request)
    {
        $ip = $request->ip();
        $oneHourAgo = Carbon::now()->subHour(); // Mundur 1 jam dari sekarang

        // Cek apakah device (IP) ini sudah melihat berita ini dalam 1 jam terakhir
        $hasViewedRecently = DB::table('news_views')
            ->where('news_id', $id)
            ->where('ip_address', $ip)
            ->where('created_at', '>=', $oneHourAgo)
            ->exists();

        // Jika belum melihat / sudah lewat 1 jam, tambah view
        if (!$hasViewedRecently) {
            // Log ke history
            DB::table('news_views')->insert([
                'news_id' => $id,
                'ip_address' => $ip,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            // Tambahkan angka views_count di tabel utama
            DB::table('news')->where('id', $id)->increment('views_count');

            return response()->json(['status' => 'counted']);
        }

        return response()->json(['status' => 'ignored (cooldown)']);
    }
}