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
        'saved',
        'cv_path_hidden_info',
        'approve_application',
        'cv_path_resubmit',
        'summary',
        'order_id',
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
    public function cv()
    {
        return $this->belongsTo(CV::class);
    }
}
