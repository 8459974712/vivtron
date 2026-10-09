<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppSetting extends Model
{
    protected $fillable = ['key', 'value'];

    protected $casts = [
        'value' => 'encrypted',
    ];

    public static function valueFor(string $key, mixed $default = null): mixed
    {
        $setting = static::where('key', $key)->first();

        return $setting?->value ?? $default;
    }

    public static function put(string $key, mixed $value): self
    {
        return static::updateOrCreate(['key' => $key], ['value' => $value]);
    }
}
