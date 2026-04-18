<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Services\ActivityService;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    protected ActivityService $activityService;

    public function __construct(ActivityService $activityService)
    {
        $this->activityService = $activityService;
    }

    public function index()
    {
        $activities = $this->activityService->getAllActivities();
        return view('admin.activities.index', compact('activities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'start_date' => 'required|date', // Sesuai dengan form HTML dan Model
            'end_date' => 'nullable|date|after_or_equal:start_date', // Opsional, tapi jika diisi formatnya harus tanggal
            'time' => 'required',
            'location' => 'required|string|max:255',
        ]);

        $this->activityService->createActivity($request->all());

        return redirect()->route('admin.activities.index')->with('success', 'Kegiatan berhasil ditambahkan.');
    }

    public function update(Request $request, Activity $activity)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'time' => 'required',
            'location' => 'required|string|max:255',
        ]);

        $this->activityService->updateActivity($activity, $request->all());

        return redirect()->route('admin.activities.index')->with('success', 'Kegiatan berhasil diperbarui.');
    }

    public function destroy(Activity $activity)
    {
        $this->activityService->deleteActivity($activity);
        return redirect()->route('admin.activities.index')->with('success', 'Kegiatan berhasil dihapus.');
    }
}