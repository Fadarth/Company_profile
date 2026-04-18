<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouncilEquipment extends Model
{
    protected $table = 'council_equipments';

    use HasFactory;

    protected $fillable = [
        'name',
        'icon_class',
        'rank',
        'slug',
        'task_scope',
        'work_partners',
    ];
}
