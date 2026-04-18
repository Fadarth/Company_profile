<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aspiration extends Model
{
    protected $fillable = [
        'name',
        'contact',
        'category',
        'message',
        'status',
        'is_published'
    ];
}