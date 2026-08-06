<?php

namespace App\Models;

use App\Models\Traits\HasLocaleFields;
use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
    use HasLocaleFields;

    protected $guarded = [];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Route Model Binding باستخدام الـ slug
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * الخدمات التابعة للتصنيف
     */
    public function services()
    {
        return $this->hasMany(Service::class)
            ->orderBy('order');
    }

    /**
     * Scope للخدمات المفعلة
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true)
            ->orderBy('order');
    }
}
