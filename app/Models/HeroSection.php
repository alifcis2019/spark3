<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeroSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'button_text',
        'button_url',
        'is_active',
        'sort_order'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Scope for active hero sections
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope for ordered hero sections
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }
}
