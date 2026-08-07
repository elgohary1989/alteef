<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutTimeline extends Model
{
    protected $table = 'about_timelines';

    protected $fillable = [

        'about_us_id',

        'year',

        'title_ar',
        'title_en',

        'description_ar',
        'description_en',

        'sort_order',
    ];

    public function about()
    {
        return $this->belongsTo(AboutUs::class, 'about_us_id');
    }
}
