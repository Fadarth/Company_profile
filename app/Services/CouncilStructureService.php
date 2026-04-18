<?php

namespace App\Services;

use App\Models\CouncilStructure;
use Illuminate\Support\Facades\Storage; // Gunakan Storage, bukan File

class CouncilStructureService
{
    // Mengambil data pertama, jika kosong otomatis buat data default
    public function getStructure()
    {
        return CouncilStructure::firstOrCreate(
            ['id' => 1],
            [
                'title' => 'Struktural Dewan',
                'description' => 'Dokumen resmi susunan organisasi.',
                'file_path' => null
            ]
        );
    }

    public function update(array $data, $file = null)
    {
        $structure = $this->getStructure();

        // Update teks
        $structure->title = $data['title'];
        $structure->description = $data['description'];

        // Handle upload PDF jika ada file baru
        if ($file) {
            // Hapus file lama jika ada di storage
            if ($structure->file_path && Storage::disk('public')->exists($structure->file_path)) {
                Storage::disk('public')->delete($structure->file_path);
            }

            // Buat nama file unik (menghilangkan spasi pada nama file agar lebih aman)
            $fileName = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());

            // Simpan ke storage/app/public/documents
            $path = $file->storeAs('documents', $fileName, 'public');

            // Simpan path ke database
            $structure->file_path = $path;
        }

        $structure->save();

        return $structure;
    }
}
