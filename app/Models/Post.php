<?php

namespace App\Models;
use Cviebrock\EloquentSluggable\Sluggable;

use App\Models\Category;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;

class Post extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'slug',
        'date',
        'content',
        'photo'
    ];

    // public function author(): BelongsTo
    // {
    //     return $this->belongsTo(User::class, 'user_id', 'id');
    // }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }

    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->translatedFormat('l, d F Y, H:i');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
