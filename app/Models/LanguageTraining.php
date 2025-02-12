<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class LanguageTraining extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description', 'status'];
     public static function boot()
    {
        parent::boot();

        static::creating(function ($languageTraining) {
            $languageTraining->slug = Str::slug($languageTraining->name);
        });

        static::updating(function ($languageTraining) {
            $languageTraining->slug = Str::slug($languageTraining->name);
        });
    }
}
