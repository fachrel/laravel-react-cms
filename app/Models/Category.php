<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Category extends Model
{
    use HasFactory, Sluggable;
    
    protected $fillable = [
        'name',
        'slug',
    ];

    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->translatedFormat('l, d F Y, H:i');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
