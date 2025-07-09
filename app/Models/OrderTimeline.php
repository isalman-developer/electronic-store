<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderTimeline extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'user_id',
        'status',
        'description'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Get title based on status
    public function getTitleAttribute()
    {
        return match ($this->status) {
            'pending' => 'Order Pending',
            'paid' => 'Payment Confirmed',
            'shipped' => 'Order Shipped',
            'delivered' => 'Order Delivered',
            'completed' => 'Order Completed',
            'canceled' => 'Order Canceled',
            default => ucfirst($this->status)
        };
    }

    // Get icon based on status
    public function getIconAttribute()
    {
        return 'bx bx-check-circle';
    }

    // Get icon class based on status
    public function getIconClassAttribute()
    {
        return match ($this->status) {
            'canceled' => 'text-danger',
            'completed' => 'text-success',
            default => 'text-primary'
        };
    }
}
