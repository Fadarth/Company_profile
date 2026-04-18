<?php

namespace App\Services;

use App\Models\OrganizationData;
use Illuminate\Support\Facades\Storage; // Gunakan Storage
use Illuminate\Http\UploadedFile;
use Illuminate\Database\Eloquent\Collection;

class OrganizationDataService
{
    public function getAllData(): Collection
    {
        return OrganizationData::latest()->get();
    }

    public function createData(array $data, UploadedFile $file): OrganizationData
    {
        $fileName = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());

        // Simpan ke storage/app/public/documents
        $path = $file->storeAs('documents', $fileName, 'public');
        $data['file_path'] = $path;

        return OrganizationData::create($data);
    }

    public function updateData(OrganizationData $organization, array $data, ?UploadedFile $file): OrganizationData
    {
        if ($file) {
            // Hapus file lama jika ada di storage
            if ($organization->file_path && Storage::disk('public')->exists($organization->file_path)) {
                Storage::disk('public')->delete($organization->file_path);
            }

            $fileName = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());

            // Simpan file baru
            $path = $file->storeAs('documents', $fileName, 'public');
            $data['file_path'] = $path;
        }

        $organization->update($data);

        return $organization;
    }

    public function deleteData(OrganizationData $organization): bool
    {
        // Hapus file saat data dihapus
        if ($organization->file_path && Storage::disk('public')->exists($organization->file_path)) {
            Storage::disk('public')->delete($organization->file_path);
        }

        return $organization->delete();
    }
}
