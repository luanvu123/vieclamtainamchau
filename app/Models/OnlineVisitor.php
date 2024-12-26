<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnlineVisitor extends Model
{
    use HasFactory;

    protected $fillable = ['ip_address', 'last_active'];
    protected $dates = ['last_active'];

    // Phương thức theo dõi và cập nhật thông tin người truy cập
    public static function trackVisitor($ipAddress)
    {
        return self::updateOrCreate(
            ['ip_address' => $ipAddress],
            ['last_active' => now()]
        );
    }
}

