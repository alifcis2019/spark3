<?php
// app/Models/Service.php (Updated)
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'title_en',
        'slug',
        'description',
        'description_en',
        'content',
        'content_en',
        'icon',
        'featured_image',
        'is_featured',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($service) {
            if (empty($service->slug)) {
                $service->slug = Str::slug($service->title);
            }
        });
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    // Get localized title
    public function getLocalizedTitle()
    {
        return app()->getLocale() == 'ar' ? $this->title : ($this->title_en ?? $this->title);
    }

    // Get localized description
    public function getLocalizedDescription()
    {
        return app()->getLocale() == 'ar' ? $this->description : ($this->description_en ?? $this->description);
    }

    // Get localized content
    public function getLocalizedContent()
    {
        return app()->getLocale() == 'ar' ? $this->content : ($this->content_en ?? $this->content);
    }
}
