<?php

namespace App\Services;

use App\Models\CouncilMember;
use Illuminate\Support\Facades\Storage; // Gunakan Storage
use Illuminate\Http\UploadedFile;
use Illuminate\Database\Eloquent\Collection;

class CouncilMemberService
{
    public function getAllMembers(): Collection
    {
        return CouncilMember::orderBy('rank', 'asc')->get();
    }

    public function createMember(array $data, ?UploadedFile $image): CouncilMember
    {
        if ($image) {
            $fileName = time() . '_' . $image->getClientOriginalName();
            // Simpan ke storage/app/public/members
            $path = $image->storeAs('members', $fileName, 'public');
            $data['image_path'] = $path; // Hasilnya akan berupa 'members/namafile.ext'
        }

        return CouncilMember::create($data);
    }

    public function updateMember(CouncilMember $member, array $data, ?UploadedFile $image): CouncilMember
    {
        if ($image) {
            // Hapus gambar lama jika ada di storage
            if ($member->image_path && Storage::disk('public')->exists($member->image_path)) {
                Storage::disk('public')->delete($member->image_path);
            }

            $fileName = time() . '_' . $image->getClientOriginalName();
            $path = $image->storeAs('members', $fileName, 'public');
            $data['image_path'] = $path;
        }

        $member->update($data);

        return $member;
    }

    public function deleteMember(CouncilMember $member): bool
    {
        // Hapus gambar saat data dihapus
        if ($member->image_path && Storage::disk('public')->exists($member->image_path)) {
            Storage::disk('public')->delete($member->image_path);
        }

        return $member->delete();
    }
}
