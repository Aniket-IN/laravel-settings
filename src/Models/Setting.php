<?php

namespace AniketIN\Settings\Models;

use AniketIN\Settings\Facades\Settings;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::saved(function ($setting) {
            Settings::refreshCache();
        });

        static::deleted(function ($setting) {
            Settings::refreshCache();
        });
    }

    protected function value(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => unserialize($value),
            set: fn ($value) => serialize($value),
        );
    }
}
