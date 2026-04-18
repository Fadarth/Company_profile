<?php

namespace App\Http\Controllers;

use App\Services\CouncilStructureService;
use Illuminate\Http\Request;

class CouncilStructureController extends Controller
{
    protected $councilStructureService;

    public function __construct(CouncilStructureService $councilStructureService)
    {
        $this->councilStructureService = $councilStructureService;
    }

    public function index()
    {
        $structure = $this->councilStructureService->getStructure();
        return view('admin.council-structures.index', compact('structure'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'file' => 'nullable|mimes:pdf|max:5120', // Maks 5MB, hanya PDF
        ]);

        $this->councilStructureService->update($validated, $request->file('file'));

        return back()->with('success', 'Data Struktural Dewan berhasil diperbarui.');
    }
}