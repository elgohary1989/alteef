<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutValue extends Model
{
    protected $table = 'about_values';

    protected $fillable = [

        'about_us_id',

        'title_ar',
        'title_en',

        'icon',

        'sort_order',
    ];

    public function about()
    {
        return $this->belongsTo(AboutUs::class, 'about_us_id');
    }
}
