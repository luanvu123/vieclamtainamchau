<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'status'];

    public function employers()
    {
        return $this->belongsToMany(Employer::class, 'employer_genre');
    }
    public function jobPostings()
    {
        return $this->belongsToMany(JobPosting::class, 'genre_jobposting');
    }
}

