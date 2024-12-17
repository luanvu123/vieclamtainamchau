<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'image', 'status'];
     public function jobPostings()
    {
        return $this->belongsToMany(JobPosting::class, 'country_job_posting');
    }
}
