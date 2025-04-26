<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CV extends Model
{
    use HasFactory;

    protected $table = 'cvs';

    protected $fillable = [
        'title',
        'file_path',
        'file_name',
        'file_type',
        'file_size',
        'is_template',
        'is_public',
        'description'
    ];

    protected $casts = [
        'is_template' => 'boolean',
        'is_public' => 'boolean',
        'file_size' => 'integer'
    ];

    public function candidates()
    {
        return $this->belongsToMany(Candidate::class, 'candidate_cv')
                    ->withPivot('is_primary', 'is_active')
                    ->withTimestamps();
    }
}
