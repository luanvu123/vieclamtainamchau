<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['user_id', 'name', 'image', 'status', 'slug'];
    public function candidates()
    {
        return $this->belongsToMany(Candidate::class, 'candidate_category');
    }

    public function employers()
    {
        return $this->belongsToMany(Employer::class, 'employer_category');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function jobPostings()
    {
        return $this->belongsToMany(JobPosting::class, 'category_job_posting');
    }
}

