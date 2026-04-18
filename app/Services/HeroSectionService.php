<?php

namespace App\Services;

use App\Models\HeroSection;
use Illuminate\Support\Facades\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class HeroSectionService
{
    /**
     * Get the single hero section record. Creates it if it doesn't exist.
     */
    public function getHeroData(): HeroSection
    {
        return HeroSection::firstOrCreate(
            ['id' => 1],
            [
                'title' => 'Suara Rakyat, <br> <span class="text-orange-600">Aspirasi Bangsa</span>',
                'image_path' => null
            ]
        );
    }

    public function updateHeroData(array $data, ?UploadedFile $image): HeroSection
    {
        $hero = $this->getHeroData();

        if ($image) {
            if ($hero->image_path && Storage::disk('public')->exists('hero/' . $hero->image_path)) {
                Storage::disk('public')->delete('hero/' . $hero->image_path);
            }

            $fileName = time() . '_' . $image->hashName();

            $image->storeAs('hero', $fileName, 'public');

            $data['image_path'] = $fileName;
        }

        $hero->update($data);
        return $hero;
    }
}
