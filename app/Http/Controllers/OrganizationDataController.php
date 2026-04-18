<?php

namespace App\Http\Controllers;

use App\Models\OrganizationData;
use App\Services\OrganizationDataService;
use Illuminate\Http\Request;

class OrganizationDataController extends Controller
{
    protected OrganizationDataService $organizationDataService;

    public function __construct(OrganizationDataService $organizationDataService)
    {
        $this->organizationDataService = $organizationDataService;
    }

    public function index()
    {
        $organizations = $this->organizationDataService->getAllData();
        return view('admin.organizations.index', compact('organizations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'file' => 'required|mimes:pdf|max:5120', // Maksimal 5MB, hanya PDF
        ]);

        $this->organizationDataService->createData($request->only('title'), $request->file('file'));

        return redirect()->route('admin.organizations.index')->with('success', 'Dokumen berhasil ditambahkan.');
    }

    public function update(Request $request, OrganizationData $organization)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'file' => 'nullable|mimes:pdf|max:5120',
        ]);

        $this->organizationDataService->updateData($organization, $request->only('title'), $request->file('file'));

        return redirect()->route('admin.organizations.index')->with('success', 'Dokumen berhasil diperbarui.');
    }

    public function destroy(OrganizationData $organization)
    {
        $this->organizationDataService->deleteData($organization);
        return redirect()->route('admin.organizations.index')->with('success', 'Dokumen berhasil dihapus.');
    }
}