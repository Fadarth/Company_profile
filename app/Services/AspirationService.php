<?php

namespace App\Services;

use App\Models\Aspiration;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;

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
    public function storePublicAspiration(array $data, string $ipAddress) // Tambahkan parameter $ipAddress
    {
        $recentAspiration = Aspiration::where('ip_address', $ipAddress)
            ->where('created_at', '>=', Carbon::now()->subHour())
            ->first();

        if ($recentAspiration) {
            throw ValidationException::withMessages([
                'limit' => 'Anda baru saja mengirimkan aspirasi. Silakan tunggu 1 jam lagi untuk mengirim kembali.'
            ]);
        }

        // 3. Jika aman, simpan datanya
        return Aspiration::create([
            'name' => $data['name'],
            'contact' => $data['contact'] ?? null,
            'category' => $data['category'],
            'message' => $data['message'],
            'ip_address' => $ipAddress, // Simpan IP-nya
            'status' => 'dalam_proses',
            'is_published' => false,
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
