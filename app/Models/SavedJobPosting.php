<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavedJobPosting extends Model
{
    use HasFactory;

    protected $table = 'saved_job_postings';

    protected $fillable = [
        'candidate_id',
        'job_posting_id',
    ];

    // Mối quan hệ với Candidate
    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }

    // Mối quan hệ với JobPosting
    public function jobPosting()
    {
        return $this->belongsTo(JobPosting::class);
    }
}
