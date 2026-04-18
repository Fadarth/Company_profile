<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category',
        'published_date',
        'description',
        'image_path',
    ];

    public function getFormattedDateAttribute()
    {
        return Carbon::parse($this->published_date)->translatedFormat('j F Y');
    }
}