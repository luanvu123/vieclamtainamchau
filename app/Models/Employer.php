<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Employer extends Authenticatable
{
    use Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'employers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'password',
        'gender',
        'phone',
        'status',
        'avatar',
        'business_license',
        'commission',
        'identification_card',
        'identification_card_behind',
        'company_name',
        'slug',
        'logo',
        'otp',
        'isVerify',
        'isVerify_license',
        'isVerifyCompany',
        'isInfomation',
        'IsBasicnews',
        'isUrgentrecruitment',
        'IsPartner',
        'IsRefresheveryhour',
        'IsRefresheveryday',
        'IsDarkredeffect',
        'IsFramingeffect',
        'IsHoteffect',
        'isVerifyEmail',
        'level',
        'mst',
        'scale',
        'address',
        'map',
        'url',
        'website',
        'detail',
        'facebook',
        'twitter',
         'verification_token',
         'remember_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'otp',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'status' => 'boolean',
        'isVerify' => 'boolean',
        'isVerify_license' => 'boolean',
        'isVerifyCompany' => 'boolean',
        'isInfomation' => 'boolean',
        'IsBasicnews' => 'boolean',
        'isUrgentrecruitment' => 'boolean',
        'IsPartner' => 'boolean',
        'IsRefresheveryhour' => 'boolean',
        'IsRefresheveryday' => 'boolean',
        'IsDarkredeffect' => 'boolean',
        'IsFramingeffect' => 'boolean',
        'IsHoteffect' => 'boolean',
        'isVerifyEmail' => 'boolean',
    ];

    /**
     * Relationships
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'employer_category');
    }
    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'employer_genre');
    }
    public function gallery()
    {
        return $this->hasMany(CompanyGallery::class)->orderBy('sort_order');
    }
    public function jobPostings()
    {
        return $this->hasMany(JobPosting::class, 'employer_id');
    }
    /**
     * Get all active gallery images.
     */
    public function activeGallery()
    {
        return $this->gallery()->where('is_active', true);
    }
}
