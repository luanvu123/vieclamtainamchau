<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'employer_id',
        'order_key',
        'status',
        'total_price',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'total_price' => 'decimal:2',
    ];

    /**
     * Get the employer that owns the order.
     */
    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }

    /**
     * Get the order details for this order.
     */
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    /**
     * Generate a unique order key.
     *
     * @return string
     */
    public static function generateOrderKey()
    {
        $prefix = 'ORD';
        $timestamp = now()->format('YmdHis');
        $random = strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 6));

        return $prefix . '-' . $timestamp . '-' . $random;
    }
}
