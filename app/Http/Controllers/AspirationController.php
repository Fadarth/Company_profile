<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Aspiration;
use App\Services\AspirationService;
use Illuminate\Http\Request;

class AspirationController extends Controller
{
    protected $aspirationService;

    public function __construct(AspirationService $aspirationService)
    {
        $this->aspirationService = $aspirationService;
    }

    public function index()
    {
        $aspirations = $this->aspirationService->getAllForAdmin();
        return view('admin.aspirations.index', compact('aspirations'));
    }

    public function update(Request $request, Aspiration $aspiration)
    {
        $validated = $request->validate([
            'status' => 'required|in:dalam_proses,ditindaklanjuti,selesai',
            'is_published' => 'required|boolean',
        ]);

        $this->aspirationService->updateByAdmin($aspiration, $validated);

        return back()->with('success', 'Status Aspirasi berhasil diperbarui.');
    }

    public function destroy(Aspiration $aspiration)
    {
        $this->aspirationService->delete($aspiration);
        return back()->with('success', 'Aspirasi berhasil dihapus.');
    }
}