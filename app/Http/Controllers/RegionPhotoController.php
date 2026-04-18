<?php

namespace App\Http\Controllers;

use App\Models\RegionPhoto;
use App\Services\RegionPhotoService;
use Illuminate\Http\Request;

class RegionPhotoController extends Controller
{
    protected RegionPhotoService $regionPhotoService;

    public function __construct(RegionPhotoService $regionPhotoService)
    {
        $this->regionPhotoService = $regionPhotoService;
    }

    public function index()
    {
        $photos = $this->regionPhotoService->getAllPhotos();
        return view('admin.regions.index', compact('photos'));
    }

    public function create()
    {
        return view('admin.regions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $this->regionPhotoService->createPhoto($request->only('name'), $request->file('image'));

        return redirect()->route('admin.regions.index')->with('success', 'Foto daerah berhasil ditambahkan.');
    }

    public function edit(RegionPhoto $region)
    {
        return view('admin.regions.edit', compact('region'));
    }

    public function update(Request $request, RegionPhoto $region)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $this->regionPhotoService->updatePhoto($region, $request->only('name'), $request->file('image'));

        return redirect()->route('admin.regions.index')->with('success', 'Foto daerah berhasil diperbarui.');
    }

    public function destroy(RegionPhoto $region)
    {
        $this->regionPhotoService->deletePhoto($region);
        return redirect()->route('admin.regions.index')->with('success', 'Foto daerah berhasil dihapus.');
    }
}