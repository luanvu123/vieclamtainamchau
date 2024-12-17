<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Candidate extends Authenticatable
{
    use HasFactory;

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
        'cv_path',
        'status',
        'verification_token',
        'gender',
        'address',
        'skill',
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
}

