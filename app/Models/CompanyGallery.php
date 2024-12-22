<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class CompanyGallery extends Model
{
    protected $fillable = [
        'employer_id',
        'image_path',
        'caption',
        'sort_order',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }
}

