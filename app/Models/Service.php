<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    // Khai báo các cột có thể được gán giá trị
    protected $fillable = [
        'name',
        'image',
        'price',
        'description',
        'status',
    ];

    // Trạng thái dưới dạng enum hoặc hằng số
    public const STATUS_ACTIVE = 'active';
    public const STATUS_INACTIVE = 'inactive';
}

