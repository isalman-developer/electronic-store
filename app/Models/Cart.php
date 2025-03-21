<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'session_id'];

    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Calculate total price of cart
    public function getTotalAttribute()
    {
        return $this->items->sum(function($item) {
            if ($item->product_variant_id && $item->variant->price) {
                return $item->variant->price * $item->quantity;
            }
            return $item->product->price * $item->quantity;
        });
    }
}
