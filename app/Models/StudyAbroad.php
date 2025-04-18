<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class StudyAbroad extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description', 'image', 'status', 'short_detail','order_id', 'employer_id'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($studyAbroad) {
            $studyAbroad->slug = Str::slug($studyAbroad->name);
        });

        static::updating(function ($studyAbroad) {
            $studyAbroad->slug = Str::slug($studyAbroad->name);
        });
    }


    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_study_abroad');
    }

    public function countries()
    {
        return $this->belongsToMany(Country::class, 'country_study_abroad');
    }
    public function savedByCandidates()
    {
        return $this->hasMany(SavedStudyAbroad::class, 'study_abroad_id');
    }
    public function employer()
{
    return $this->belongsTo(Employer::class);
}
public function candidatesToday()
{
    return $this->hasMany(CandidateStudyAbroad::class, 'study_abroad_id')
                ->where('created_at', '>=', now()->subDay());
}

}
