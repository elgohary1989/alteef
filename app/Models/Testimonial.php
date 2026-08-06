<?php

namespace App\Models;

use App\Models\Traits\HasLocaleFields;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasLocaleFields;

    protected $guarded = [];

    protected $casts = ['is_active' => 'boolean'];

    public function scopeActive($q)
    {
        return $q->where('is_active', true)->orderBy('order');
    }
}
