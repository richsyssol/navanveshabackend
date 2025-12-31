<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FestivalGallery extends Model
{
    protected $fillable = ['category_id', 'images', 'is_active', 'sort_order'];

    protected $casts = [
        'images' => 'array',
        'is_active' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(FestivalCategory::class, 'category_id');
    }

    public function scopeActive($q)
    {
        return $q->where('is_active', 1);
    }

    public function scopeOrdered($q)
    {
        return $q->orderBy('sort_order')->orderBy('created_at', 'desc');
    }
}
