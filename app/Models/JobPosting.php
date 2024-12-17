<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPosting extends Model
{
    use HasFactory;

    protected $fillable = [
        'employer_id', 'title', 'slug', 'type', 'age_range', 'location', 'tags',
        'description', 'application_email_url', 'closing_date', 'salary', 'experience',
        'rank', 'number_of_recruits', 'sex', 'status', 'skills_required',
        'area', 'city', 'isHot', 'views'
    ];

    /**
     * Relationship with Country.
     */
    public function countries()
    {
        return $this->belongsToMany(Country::class, 'country_job_posting');
    }

    /**
     * Relationship with Category.
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_job_posting');
    }

    /**
     * Relationship with Employer.
     */
    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }
}

