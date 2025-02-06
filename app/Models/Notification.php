<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'candidate_id',
        'title',
        'message',
        'type',
        'is_read',
        'link'
    ];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}
