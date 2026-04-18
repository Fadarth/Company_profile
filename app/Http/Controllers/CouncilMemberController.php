<?php

namespace App\Http\Controllers;

use App\Models\CouncilMember;
use App\Services\CouncilMemberService;
use Illuminate\Http\Request;

class CouncilMemberController extends Controller
{
    protected CouncilMemberService $councilMemberService;

    public function __construct(CouncilMemberService $councilMemberService)
    {
        $this->councilMemberService = $councilMemberService;
    }

    public function index()
    {
        $members = $this->councilMemberService->getAllMembers();
        return view('admin.members.index', compact('members'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'rank' => 'required|integer|min:1',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $this->councilMemberService->createMember($request->except('image'), $request->file('image'));

        return redirect()->route('admin.members.index')->with('success', 'Anggota berhasil ditambahkan.');
    }

    public function update(Request $request, CouncilMember $member)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'rank' => 'required|integer|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $this->councilMemberService->updateMember($member, $request->except('image'), $request->file('image'));

        return redirect()->route('admin.members.index')->with('success', 'Data anggota berhasil diperbarui.');
    }

    public function destroy(CouncilMember $member)
    {
        $this->councilMemberService->deleteMember($member);
        return redirect()->route('admin.members.index')->with('success', 'Anggota berhasil dihapus.');
    }
}