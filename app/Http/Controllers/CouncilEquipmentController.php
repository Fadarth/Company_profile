<?php

namespace App\Http\Controllers;

use App\Models\CouncilEquipment;
use App\Services\CouncilEquipmentService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CouncilEquipmentController extends Controller
{
    protected $councilEquipmentService;

    public function __construct(CouncilEquipmentService $councilEquipmentService)
    {
        $this->councilEquipmentService = $councilEquipmentService;
    }

    public function index()
    {
        $equipments = $this->councilEquipmentService->getAll();
        return view('admin.council-equipments.index', compact('equipments'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'icon_class' => 'required|string|max:255',
            'rank' => 'nullable|integer',
            'task_scope' => 'nullable|string',    // Tambahkan ini
            'work_partners' => 'nullable|string', // Tambahkan ini
        ]);

        $this->councilEquipmentService->store($validated);

        return back()->with('success', 'Alat Kelengkapan Dewan berhasil ditambahkan.');
    }

    public function update(Request $request, CouncilEquipment $councilEquipment)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'icon_class' => 'required|string|max:255',
            'rank' => 'nullable|integer',
            'task_scope' => 'nullable|string',    // Tambahkan ini
            'work_partners' => 'nullable|string', // Tambahkan ini
        ]);

        $this->councilEquipmentService->update($councilEquipment, $validated);

        return back()->with('success', 'Alat Kelengkapan Dewan berhasil diperbarui.');
    }

    public function destroy(CouncilEquipment $councilEquipment)
    {
        $this->councilEquipmentService->delete($councilEquipment);

        return back()->with('success', 'Alat Kelengkapan Dewan berhasil dihapus.');
    }
}
