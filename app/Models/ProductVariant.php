<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductVariant extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'variant_name', 'variant_value', 'price', 'stock'];

    // A product variant belongs to one product
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
