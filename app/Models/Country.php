<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'image', 'status', 'hot'];
     public function jobPostings()
    {
        return $this->belongsToMany(JobPosting::class, 'country_job_posting');
    }
    public function studyAbroads()
{
    return $this->belongsToMany(StudyAbroad::class, 'country_study_abroad');
}

}
