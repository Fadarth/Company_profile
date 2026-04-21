<?php

namespace App\Http\Controllers;

use App\Services\AspirationService;
use Illuminate\Http\Request;

class PublicAspirationController extends Controller
{
    protected $aspirationService;

    public function __construct(AspirationService $aspirationService)
    {
        $this->aspirationService = $aspirationService;
    }

    public function create()
    {
        return view('public.aspirations.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'contact' => 'nullable|string|max:255',
            'category' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        try {
            $this->aspirationService->storePublicAspiration($validated, $request->ip());

            return redirect('/#aspirasi')->with('success_aspiration', 'Terima kasih, aspirasi Anda telah berhasil dikirim dan akan segera diproses.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect('/#aspirasi')->withErrors($e->errors())->withInput();
        }
    }
}
