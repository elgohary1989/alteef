<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name_ar',
        'name_en',
        'slug',
        'description_ar',
        'description_en',
        'featured_image',
        'meta_title',
        'meta_description',
        'is_active',
    ];

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
    public function trans(string $field): string
    {
        $locale = app()->getLocale();

        $column = $field . '_' . $locale;

        return $this->{$column} ?? '';
    }
}
