<?php

namespace App\Models;

use App\Models\Review;
use App\Models\Category;
use App\Core\Model\Model;
use App\Models\ProductVariant;
use App\Models\Scopes\ActiveProductScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

#[ScopedBy([ActiveProductScope::class])]
class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id',
        'title',
        'brand_id',
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

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    //special functions
    public function getAverageRatingAttribute()
    {
        return $this->reviews()->avg('rating') ?: 0;
    }

    public function scopeFilter(Builder $query, array $filters): Builder
    {
        // Price range filter
        if (isset($filters['price_min'])) {
            $query->where('price', '>=', $filters['price_min']);
        }

        if (isset($filters['price_max'])) {
            $query->where('price', '<=', $filters['price_max']);
        }

        // Category filter
        if (isset($filters['category'])) {
            $query->whereHas('category', function($q) use ($filters) {
                $q->where('slug', $filters['category']);
            });
        }

        // Brand filter
        if (isset($filters['brand'])) {
            $query->whereHas('brand', function($q) use ($filters) {
                $q->where('slug', $filters['brand']);
            });
        }

        // Color filter
        if (isset($filters['color'])) {
            $query->whereHas('colors', function($q) use ($filters) {
                $q->where('slug', $filters['color']);
            });
        }

        // Size filter
        if (isset($filters['size'])) {
            $query->whereHas('sizes', function($q) use ($filters) {
                $q->where('slug', $filters['size']);
            });
        }

        // Sorting
        if (isset($filters['sort'])) {
            switch ($filters['sort']) {
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
                case 'newest':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'rating':
                    $query->withAvg('reviews', 'rating')
                          ->orderByDesc('reviews_avg_rating');
                    break;
            }
        }

        return $query;
    }
}
