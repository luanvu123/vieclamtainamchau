<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceWeek extends Model
{
    use HasFactory;

    protected $table = 'service_weeks';

    protected $fillable = [
        'service_id',
        'number_of_weeks',
    ];

    // Quan hệ ngược: mỗi service_week thuộc về một service
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    // Danh sách tuần được hỗ trợ
    public const WEEK_OPTIONS = [1, 2, 4];

    // Scope lọc theo số tuần
    public function scopeForWeek($query, $week)
    {
        return $query->where('number_of_weeks', $week);
    }
}
