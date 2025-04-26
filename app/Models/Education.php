<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;
  protected $table = 'educations';
    protected $fillable = [
        'candidate_id',
        'institution_name',
        'degree',
        'field_of_study',
        'description',
        'start_date',
        'end_date',

    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}
