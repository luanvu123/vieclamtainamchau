<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateStudyAbroad extends Model
{
    use HasFactory;
 protected $table = 'candidate_study_abroad';
    protected $fillable = [
        'candidate_id',
        'study_abroad_id',
        'name',
        'phone',
        'address'
    ];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }

    public function studyAbroad()
    {
        return $this->belongsTo(StudyAbroad::class);
    }
}
