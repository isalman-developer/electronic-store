<?php

namespace App\Models;

use App\Models\Product;
use App\Core\Model\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'tag_number',
        'description',
        'status',
        'meta_title',
        'meta_keywords',
        'meta_description',
    ];

    // A category has many products
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    // A category has an image
    public function media(): MorphOne
    {
        return $this->morphOne(Media::class, 'mediable');
    }
}
