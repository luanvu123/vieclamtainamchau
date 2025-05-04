<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KeySearch extends Model
{
    protected $table = 'key_search';

    protected $fillable = [
        'name', 'url', 'status',
    ];
}
