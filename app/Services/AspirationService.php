<?php

namespace App\Services;

use App\Models\Aspiration;

class AspirationService
{
    // Untuk Admin: Ambil semua data
    public function getAllForAdmin()
    {
        return Aspiration::latest()->get();
    }

    // Untuk Landing Page: Hanya ambil yang di-publish oleh admin
    public function getPublishedForLanding()
    {
        return Aspiration::where('is_published', 1)->latest()->take(6)->get(); // Batasi 6 data terbaru
    }

    // Untuk Masyarakat: Menyimpan aspirasi baru
    public function storePublicAspiration(array $data)
    {
        return Aspiration::create([
            'name' => $data['name'],
            'contact' => $data['contact'] ?? null,
            'category' => $data['category'],
            'message' => $data['message'],
            'status' => 'dalam_proses', // Default selalu dalam proses
            'is_published' => false, // Default tidak tampil sampai di-acc admin
        ]);
    }

    // Untuk Admin: Update status dan visibilitas
    public function updateByAdmin(Aspiration $aspiration, array $data)
    {
        $aspiration->update([
            'status' => $data['status'],
            'is_published' => $data['is_published'],
        ]);

        return $aspiration;
    }

    // Untuk Admin: Hapus
    public function delete(Aspiration $aspiration)
    {
        return $aspiration->delete();
    }
}