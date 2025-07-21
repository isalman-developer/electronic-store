<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_number',
        'first_name',
        'last_name',
        'email',
        'phone',
        'shipping_address',
        'city',
        'state',
        'zip',
        'country',
        'notes',
        'payment_method',
        'payment_status',
        'total_amount',
        'status',
        'invoice_path',
        'is_returned',
        'is_refunded',
        'courier',
        'tracking_number',
        'shipping_method',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function events()
    {
        return $this->hasMany(OrderEvent::class);
    }
}
