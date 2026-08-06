<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'post_category_id',

        'title_ar',
        'title_en',

        'slug',

        'excerpt_ar',
        'excerpt_en',

        'content_ar',
        'content_en',

        'featured_image',

        'source_name_ar',
        'source_name_en',
        'source_url',

        'reading_time',

        'meta_title',
        'meta_description',

        'keywords',

        'published',
        'published_at',
    ];

    protected $casts = [
        'keywords' => 'array',
        'published' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function category()
    {
        return $this->belongsTo(PostCategory::class,'post_category_id');
    }
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
    public function trans($field)
    {
        return app()->getLocale() == 'ar'
            ? $this->{$field.'_ar'}
            : ($this->{$field.'_en'} ?: $this->{$field.'_ar'});
    }
}
