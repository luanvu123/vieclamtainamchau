<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'employer_id',
        'service_id',
        'quantity',
        'number_of_weeks',
        'total_price',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'quantity' => 'integer',
        'number_of_weeks' => 'integer',
        'total_price' => 'decimal:2',
    ];

    /**
     * Get the employer that owns the cart item.
     */
    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }

    /**
     * Get the service for this cart item.
     */
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * Calculate the total price based on service price, quantity, and weeks.
     *
     * @return float
     */
    public function calculateTotalPrice()
    {
        $service = $this->service;
        if (!$service) {
            return 0;
        }

        return $service->price * $this->quantity * $this->number_of_weeks;
    }

    /**
     * Update the total price for this cart item.
     *
     * @return void
     */
    public function updateTotalPrice()
    {
        $this->total_price = $this->calculateTotalPrice();
        $this->save();
    }

    /**
     * Get all cart items for a specific employer.
     *
     * @param int $employerId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getEmployerCart($employerId)
    {
        return self::with('service')
            ->where('employer_id', $employerId)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Get total cart count for a specific employer.
     *
     * @param int $employerId
     * @return int
     */
    public static function getEmployerCartCount($employerId)
    {
        return self::where('employer_id', $employerId)->sum('quantity');
    }

    /**
     * Get total cart value for a specific employer.
     *
     * @param int $employerId
     * @return float
     */
    public static function getEmployerCartTotal($employerId)
    {
        return self::where('employer_id', $employerId)->sum('total_price');
    }
}
