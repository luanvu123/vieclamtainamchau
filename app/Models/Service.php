<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $table = 'services';

    // Các cột có thể gán giá trị
    protected $fillable = [
        'name',
        'image',
        'price',
        'description',
        'status',
         'typeservice_id',
    ];

    // Trạng thái
    public const STATUS_ACTIVE = 'active';
    public const STATUS_INACTIVE = 'inactive';

    // Quan hệ: Một service có nhiều tuần
    public function weeks()
    {
        return $this->hasMany(ServiceWeek::class);
    }

    // Lấy danh sách số tuần dưới dạng mảng
    public function getWeekOptions(): array
    {
        return $this->weeks()->pluck('number_of_weeks')->toArray();
    }

    // Kiểm tra xem service có số tuần cụ thể không (ví dụ: trong edit form)
    public function hasWeek($week): bool
    {
        return in_array($week, $this->getWeekOptions());
    }

    // Scope lọc theo trạng thái
    public function scopeActive($query)
    {
        return $query->where('status', self::STATUS_ACTIVE);
    }
    public function typeservice()
{
    return $this->belongsTo(Typeservice::class);
}

}

