<?php

namespace App\Models;

use App\Models\Review;
use App\Models\Category;
use App\Traits\HasMedia;
use App\Models\ProductVariant;
use App\Models\Scopes\ActiveProductScope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

#[ScopedBy([ActiveProductScope::class])]
class Product extends Model
{
    use HasFactory, SoftDeletes, HasMedia;

    protected $fillable = [
        'category_id',
        'title',
        'brand',
        'description',
        'price',
        'stock',
        'weight',
        'tag_number',
        'status',
        'meta_title',
        'meta_keywords',
        'meta_description'
    ];

    // A product belongs to one category
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // A product can have multiple variants
    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }

    // A product can have multiple reviews
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    // A product can have multiple images
    public function media()
    {
        return $this->morphMany(Media::class, 'mediable');
    }

    public function colors()
    {
        return $this->belongsToMany(Color::class, 'product_color', 'product_id', 'color_id');
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'product_size', 'product_id', 'size_id');
    }

    //special functions
    public function getAverageRatingAttribute()
    {
        return $this->reviews()->avg('rating') ?: 0;
    }
}
