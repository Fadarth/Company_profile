<?php

namespace App\Http\Controllers;

use App\Services\HeroSectionService;
use Illuminate\Http\Request;

class HeroSectionController extends Controller
{
    protected HeroSectionService $heroSectionService;

    public function __construct(HeroSectionService $heroSectionService)
    {
        $this->heroSectionService = $heroSectionService;
    }

    public function edit()
    {
        $hero = $this->heroSectionService->getHeroData();
        return view('admin.hero.edit', compact('hero'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $this->heroSectionService->updateHeroData(
            $request->only('title'),
            $request->file('image')
        );

        return redirect()->back()->with('success', 'Data Beranda berhasil diperbarui.');
    }
}