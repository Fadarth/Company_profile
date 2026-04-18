<?php

namespace App\Services;

use App\Models\Activity;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class ActivityService
{
    public function getAllActivities(): Collection
    {
        return Activity::latest()->get();
    }

    public function getTodayActivities()
    {
        $today = Carbon::today()->format('Y-m-d');

        $todayActivities = Activity::where('start_date', '<=', $today)
            ->where(function ($query) use ($today) {
                $query->where('end_date', '>=', $today)
                    ->orWhereNull('end_date');
            })
            ->get();
        return $todayActivities;
    }

    public function createActivity(array $data): Activity
    {
        return Activity::create($data);
    }

    public function updateActivity(Activity $activity, array $data): Activity
    {
        $activity->update($data);
        return $activity;
    }

    public function deleteActivity(Activity $activity): bool
    {
        return $activity->delete();
    }
}