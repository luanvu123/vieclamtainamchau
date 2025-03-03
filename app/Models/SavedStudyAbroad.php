<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavedStudyAbroad extends Model
{
    use HasFactory;

    protected $table = 'saved_study_abroad';

    protected $fillable = ['candidate_id', 'study_abroad_id'];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }

    public function studyAbroad()
    {
        return $this->belongsTo(StudyAbroad::class);
    }
}
