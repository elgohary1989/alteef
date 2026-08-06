<?php

namespace App\Models\Traits;

trait HasLocaleFields
{
    /**
     * يرجع قيمة الحقل حسب اللغة الحالية، مع Fallback للعربي لو مفيش ترجمة إنجليزي.
     * الاستخدام: $service->trans('title') بدل ما تكتب title_ar / title_en يدويًا.
     */
    public function trans(string $field, ?string $locale = null): ?string
    {
        $locale = $locale ?: app()->getLocale();
        $column = "{$field}_{$locale}";

        return $this->{$column} ?: ($this->{"{$field}_ar"} ?? null);
    }
}
