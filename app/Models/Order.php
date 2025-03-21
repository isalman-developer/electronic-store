<?php

namespace App\Models;

use App\Models\User;
use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'status', 'total_price', 'shipping_address'];

    // An order belongs to one user
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // An order can have multiple order items
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
