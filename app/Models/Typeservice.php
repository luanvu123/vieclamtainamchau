<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Typeservice extends Model
{
    protected $fillable = ['name', 'status'];

    public function services()
    {
        return $this->hasMany(Service::class);
    }
}
