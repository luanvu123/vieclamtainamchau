<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id',
        'service_id',
        'quantity',
        'number_of_weeks',
        'price',
        'total_price',
        'expiring_date',
        'number_of_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'quantity' => 'integer',
        'number_of_weeks' => 'integer',
        'price' => 'decimal:2',
        'total_price' => 'decimal:2',
        'expiring_date' => 'date',
        'number_of_active' => 'integer',
    ];

    /**
     * Get the order this detail belongs to.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Get the service for this order detail.
     */
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
public function cart()
{
    return $this->belongsTo(Cart::class);
}

    /**
     * Calculate the expiring date based on the order date and number of weeks.
     *
     * @param \Carbon\Carbon $orderDate
     * @return \Carbon\Carbon
     */
    public function calculateExpiringDate($orderDate)
    {
        return $orderDate->copy()->addWeeks($this->number_of_weeks);
    }

    /**
     * Check if the order detail is active (not expired).
     *
     * @return bool
     */
    public function isActive()
    {
        return $this->expiring_date >= now();
    }
}
