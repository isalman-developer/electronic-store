<?php

namespace App\Models;

use App\Core\Model\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Size extends Model
{
    use SoftDeletes;
    protected $fillable = ['title'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_size');
    }
}
