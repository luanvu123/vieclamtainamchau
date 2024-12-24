<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        'candidate_id',
        'job_posting_id',
        'cv_path',
        'introduction',
        'status',
        'saved'
    ];
    protected $casts = [
        'saved' => 'boolean'
    ];
    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }

    public function jobPosting()
    {
        return $this->belongsTo(JobPosting::class);
    }
}
