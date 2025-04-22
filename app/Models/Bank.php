<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'branch',
        'account_number',
        'content',
        'image',
        'logo_bank',
        'status',
        'account_name',
        'swift_code',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

