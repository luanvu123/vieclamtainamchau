<?php
// app/Models/LanguageTraining.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LanguageTraining extends Model
{
    use HasFactory;

    protected $table = 'language_training';

    protected $fillable = [
        'type_language_training_id',
        'employer_id',
        'slug',
        'name',
        'start_date',
        'end_date',
        'status',
        'description',
        'image'
    ];

    public function typeLanguageTraining()
    {
        return $this->belongsTo(TypeLanguageTraining::class);
    }

    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }
}
