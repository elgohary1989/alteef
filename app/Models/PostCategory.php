<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    protected $fillable = [
        'name_ar',
        'name_en',
        'slug',
        'order'
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function trans($field)
    {
        return app()->getLocale() == 'ar'
            ? $this->{$field.'_ar'}
            : ($this->{$field.'_en'} ?: $this->{$field.'_ar'});
    }
}
