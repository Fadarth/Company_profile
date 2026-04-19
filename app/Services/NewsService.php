<?php

namespace App\Services;

use App\Models\News;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Database\Eloquent\Collection;

class NewsService
{
    public function getAllNews(): Collection
    {
        return News::orderBy('published_date', 'desc')->get();
    }

    public function createNews(array $data, UploadedFile $image): News
    {
        // Menyimpan ke folder 'news' di dalam storage/app/public/
        $fileName = time() . '_' . $image->getClientOriginalName();
        $path = $image->storeAs('news', $fileName, 'public');

        $data['image_path'] = $path; // Menyimpan path seperti: 'news/nama_file.jpg'

        return News::create($data);
    }

    public function updateNews(News $news, array $data, ?UploadedFile $image): News
    {
        if ($image) {
            // Hapus gambar lama jika ada di storage public
            if ($news->image_path && Storage::disk('public')->exists($news->image_path)) {
                Storage::disk('public')->delete($news->image_path);
            }

            $fileName = time() . '_' . $image->getClientOriginalName();
            $path = $image->storeAs('news', $fileName, 'public');

            $data['image_path'] = $path;
        }

        $news->update($data);

        return $news;
    }

    public function deleteNews(News $news): bool
    {
        // Hapus file gambar jika ada
        if ($news->image_path && Storage::disk('public')->exists($news->image_path)) {
            Storage::disk('public')->delete($news->image_path);
        }

        return $news->delete();
    }
}