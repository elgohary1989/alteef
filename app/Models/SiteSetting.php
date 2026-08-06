<?php

namespace App\Models;

use App\Models\Traits\HasLocaleFields;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasLocaleFields;

    protected $guarded = [];

    /**
     * دايمًا صف واحد بس - لو مش موجود يتنشئ بقيم فاضية.
     * الاستخدام: SiteSetting::instance()->trans('site_name')
     */
    public static function instance(): self
    {
        return static::query()->firstOrCreate([]);
    }
}
