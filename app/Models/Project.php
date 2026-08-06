<?php

namespace App\Models;

use App\Models\Traits\HasLocaleFields;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasLocaleFields;

    protected $guarded = [];

    protected $casts = [
        'gallery' => 'array',
        'modules' => 'array',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function scopeActive($query)
    {
        return $query
            ->where('is_active', true)
            ->orderBy('order');
    }

    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }
}
