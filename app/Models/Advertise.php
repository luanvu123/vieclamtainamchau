<?php

// app/Models/Advertise.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertise extends Model
{
    use HasFactory;

    protected $fillable = [
        'employer_id',
        'title',
        'image',
        'content',
        'status',
         'order_id',
    ];

    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }
}
