<?php

namespace App\Models;

use App\Models\Traits\HasLocaleFields;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasLocaleFields;

    protected $guarded = [];

    protected $casts = [
        'is_active' => 'boolean',

        'features_ar' => 'array',
        'features_en' => 'array',

        'benefits_ar' => 'array',
        'benefits_en' => 'array',

        'faqs_ar' => 'array',
        'faqs_en' => 'array',

        'gallery' => 'array',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function category()
    {
        return $this->belongsTo(
            ServiceCategory::class,
            'service_category_id'
        );
    }

    public function scopeActive($query)
    {
        return $query
            ->where('is_active', true)
            ->orderBy('order');
    }

    /*
    |--------------------------------------------------------------------------
    | Localized Accessors
    |--------------------------------------------------------------------------
    */

    public function getHeroTitleAttribute()
    {
        return app()->getLocale() === 'ar'
            ? ($this->hero_title_ar ?: $this->title_ar)
            : ($this->hero_title_en ?: $this->title_en);
    }

    public function getHeroDescriptionAttribute()
    {
        return app()->getLocale() === 'ar'
            ? $this->hero_desc_ar
            : $this->hero_desc_en;
    }

    public function getCtaTextAttribute()
    {
        return app()->getLocale() === 'ar'
            ? $this->cta_text_ar
            : $this->cta_text_en;
    }

    /*
    |--------------------------------------------------------------------------
    | JSON Accessors
    |--------------------------------------------------------------------------
    */

    public function getFeaturesAttribute()
    {
        $data = app()->getLocale() === 'ar'
            ? $this->features_ar
            : $this->features_en;

        if (is_string($data)) {
            $data = json_decode($data, true);
        }

        return is_array($data) ? $data : [];
    }

    public function getBenefitsAttribute()
    {
        $data = app()->getLocale() === 'ar'
            ? $this->benefits_ar
            : $this->benefits_en;

        if (is_string($data)) {
            $data = json_decode($data, true);
        }

        return is_array($data) ? $data : [];
    }

    public function getFaqsAttribute()
    {
        $data = app()->getLocale() === 'ar'
            ? $this->faqs_ar
            : $this->faqs_en;

        if (is_string($data)) {
            $data = json_decode($data, true);
        }

        return is_array($data) ? $data : [];
    }

    public function getGalleryAttribute($value)
    {
        if (empty($value)) {
            return [];
        }

        if (is_string($value)) {
            return json_decode($value, true) ?: [];
        }

        return is_array($value) ? $value : [];
    }
}
