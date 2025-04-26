<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'candidate_id',
        'name',
        'issuing_organization',
        'issue_date',
        'expiration_date',
        'credential_id',
        'credential_url',
        'description',
        'certificate_image_path',
    ];

    protected $casts = [
        'issue_date' => 'date',
        'expiration_date' => 'date',
    ];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}
