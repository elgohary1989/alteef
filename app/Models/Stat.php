<?php

namespace App\Models;

use App\Models\Traits\HasLocaleFields;
use Illuminate\Database\Eloquent\Model;

class Stat extends Model
{
    use HasLocaleFields;

    protected $guarded = [];

    public function scopeOrdered($q)
    {
        return $q->orderBy('order');
    }
}
