<?php

namespace App\Services;

use App\Models\News;
use Illuminate\Support\Facades\File;
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
        $destinationPath = public_path('uploads/news');
        $fileName = time() . '_' . $image->getClientOriginalName();
        $image->move($destinationPath, $fileName);

        $data['image_path'] = 'uploads/news/' . $fileName;

        return News::create($data);
    }

    public function updateNews(News $news, array $data, ?UploadedFile $image): News
    {
        if ($image) {
            if ($news->image_path && File::exists(public_path($news->image_path))) {
                File::delete(public_path($news->image_path));
            }

            $destinationPath = public_path('uploads/news');
            $fileName = time() . '_' . $image->getClientOriginalName();
            $image->move($destinationPath, $fileName);

            $data['image_path'] = 'uploads/news/' . $fileName;
        }

        $news->update($data);

        return $news;
    }

    public function deleteNews(News $news): bool
    {
        if ($news->image_path && File::exists(public_path($news->image_path))) {
            File::delete(public_path($news->image_path));
        }

        return $news->delete();
    }
}