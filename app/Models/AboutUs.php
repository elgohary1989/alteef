<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    protected $table = 'aboutus';

    protected $fillable = [

        'hero_title_ar',
        'hero_title_en',

        'hero_description_ar',
        'hero_description_en',

        'hero_image',

        'title_ar',
        'title_en',

        'description_ar',
        'description_en',

        'image',

        'vision_title_ar',
        'vision_title_en',

        'vision_ar',
        'vision_en',

        'mission_title_ar',
        'mission_title_en',

        'mission_ar',
        'mission_en',

        'years_experience',
        'projects_count',
        'clients_count',

        'cta_title_ar',
        'cta_title_en',

        'cta_description_ar',
        'cta_description_en',

        'cta_button_text_ar',
        'cta_button_text_en',

        'cta_button_link',
        'manager_image',

        'manager_name_ar',
        'manager_name_en',

        'manager_position_ar',
        'manager_position_en',

        'manager_message_ar',
        'manager_message_en',
    ];

    public function features()
    {
        return $this->hasMany(AboutFeature::class, 'about_us_id');
    }

    public function values()
    {
        return $this->hasMany(AboutValue::class, 'about_us_id');
    }

    public function timelines()
    {
        return $this->hasMany(AboutTimeline::class, 'about_us_id')
            ->orderBy('sort_order');
    }
}
