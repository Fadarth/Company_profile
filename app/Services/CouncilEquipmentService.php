<?php

namespace App\Services;

use App\Models\CouncilEquipment;
use Illuminate\Support\Str; // Tambahkan ini untuk membuat slug otomatis

class CouncilEquipmentService
{
    public function getAll()
    {
        return CouncilEquipment::orderBy('rank', 'asc')->get();
    }

    public function store(array $data)
    {
        return CouncilEquipment::create([
            'name' => $data['name'],
            'slug' => Str::slug($data['name']),
            'icon_class' => $data['icon_class'],
            'rank' => $data['rank'] ?? 0,
            'task_scope' => $data['task_scope'] ?? null,
            'work_partners' => $data['work_partners'] ?? null,
        ]);
    }

    public function update(CouncilEquipment $councilEquipment, array $data)
    {
        $councilEquipment->update([
            'name' => $data['name'],
            'slug' => Str::slug($data['name']),
            'icon_class' => $data['icon_class'],
            'rank' => $data['rank'] ?? 0,
            'task_scope' => $data['task_scope'] ?? null,
            'work_partners' => $data['work_partners'] ?? null,
        ]);

        return $councilEquipment;
    }

    public function delete(CouncilEquipment $councilEquipment)
    {
        return $councilEquipment->delete();
    }
}
