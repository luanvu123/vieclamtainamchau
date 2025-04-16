<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CandidateLanguageTraining extends Model
{
    protected $table = 'candidate_language_training';

    protected $fillable = [
        'candidate_id',
        'language_training_id',
        'name',
        'phone',
        'email',
        'note',
    ];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }

    public function training()
    {
        return $this->belongsTo(LanguageTraining::class, 'language_training_id');
    }
}
