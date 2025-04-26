<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable; // Add this line

class Candidate extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'dob',
        'avatar_candidate',
        'status',
        'verification_token',
        'gender',
        'address',
        'position',
        'is_public',
        'cv_public',
        'linkedin',
        'story',
        'letter_path',
        'google_id',
        'email_verified_at',
        'level',
        'desired_level',
        'desired_salary',
        'education_level',
        'years_of_experience',
        'working_form',
        'google2fa_secret'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'dob' => 'date',
    ];
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'candidate_category');
    }
    public function cvs()
    {
        return $this->belongsToMany(CV::class, 'candidate_cv', 'candidate_id', 'cv_id')
            ->withPivot('is_primary', 'is_active')
            ->withTimestamps();
    }

    // Phương thức tiện ích để lấy CV chính
    public function primaryCV()
    {
        return $this->belongsToMany(CV::class, 'candidate_cv')
            ->wherePivot('is_primary', true)
            ->first();
    }

    // Phương thức tiện ích để lấy các CV đang hoạt động
    public function activeCVs()
    {
        return $this->belongsToMany(CV::class, 'candidate_cv')
            ->wherePivot('is_active', true)
            ->get();
    }
    public function experiences()
    {
        return $this->hasMany(Experience::class);
    }

    public function educations()
    {
        return $this->hasMany(Education::class);
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'candidate_skill')
            ->withPivot('proficiency_level')
            ->withTimestamps();
    }

    public function softSkills()
    {
        return $this->belongsToMany(SoftSkill::class, 'candidate_soft_skill')
            ->withTimestamps();
    }

    public function languages()
    {
        return $this->belongsToMany(Language::class, 'candidate_language')
            ->withPivot('proficiency')
            ->withTimestamps();
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }
    public function savedJobPostings()
    {
        return $this->belongsToMany(JobPosting::class, 'saved_job_postings')
            ->withTimestamps();
    }
    public function savedStudyAbroad()
    {
        return $this->hasMany(SavedStudyAbroad::class, 'candidate_id');
    }
}
