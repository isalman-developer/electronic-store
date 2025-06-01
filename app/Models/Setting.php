<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'key',
        'value',
    ];

    public static function getCached($key)
    {
        return cache()->rememberForever("setting_$key", function () use ($key) {
            return static::where('key', $key)->value('value');
        });
    }

    protected static function booted()
    {
        static::saved(function ($setting) {
            cache()->forget("setting_{$setting->key}");
        });

        static::deleted(function ($setting) {
            cache()->forget("setting_{$setting->key}");
        });
    }
}
