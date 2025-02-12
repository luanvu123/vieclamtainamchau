<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisterStudy extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'address',
        'study_abroad_id',
        'status',
        'notes'
    ];

    public function studyAbroad()
    {
        return $this->belongsTo(StudyAbroad::class);
    }
}
