<?php

namespace App\Services;

use App\Models\RegionPhoto;
use Illuminate\Support\Facades\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;

class RegionPhotoService
{
    public function getAllPhotos(): Collection
    {
        return RegionPhoto::latest()->get();
    }

    public function createPhoto(array $data, UploadedFile $image): RegionPhoto
    {
        // Ganti nama jadi acak dan aman
        $fileName = time() . '_' . $image->hashName();

        // Simpan ke storage/app/public/regions
        $image->storeAs('regions', $fileName, 'public');

        // HANYA simpan nama filenya ke database
        $data['image_path'] = $fileName;

        return RegionPhoto::create($data);
    }

    public function updatePhoto(RegionPhoto $regionPhoto, array $data, ?UploadedFile $image): RegionPhoto
    {
        if ($image) {
            // Hapus gambar lama JIKA ada di storage
            if ($regionPhoto->image_path && Storage::disk('public')->exists('regions/' . $regionPhoto->image_path)) {
                Storage::disk('public')->delete('regions/' . $regionPhoto->image_path);
            }

            // Upload gambar baru dengan nama aman
            $fileName = time() . '_' . $image->hashName();
            $image->storeAs('regions', $fileName, 'public');

            $data['image_path'] = $fileName;
        }

        $regionPhoto->update($data);

        return $regionPhoto;
    }

    public function deletePhoto(RegionPhoto $regionPhoto): bool
    {
        // Hapus file fisik dari storage
        if ($regionPhoto->image_path && Storage::disk('public')->exists('regions/' . $regionPhoto->image_path)) {
            Storage::disk('public')->delete('regions/' . $regionPhoto->image_path);
        }

        // Hapus dari database
        return $regionPhoto->delete();
    }
}
