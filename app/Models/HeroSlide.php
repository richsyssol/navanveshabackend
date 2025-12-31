<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeroSlide extends Model
{
    use HasFactory;

    protected $table = 'hero_slides';

    protected $fillable = [
        'title',
        'subtitle',
        'description',
        'image',
        'icon',
        'order',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer'
    ];

    // Accessor for image_url
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            // Check if image is already a full URL
            if (filter_var($this->image, FILTER_VALIDATE_URL)) {
                return $this->image;
            }
            
            // Return full URL for stored image
            return asset('storage/' . str_replace('public/', '', $this->image));
        }
        
        return null;
    }
}