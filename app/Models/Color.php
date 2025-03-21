<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Color extends Model
{
    use SoftDeletes;

    protected $fillable = ['title','color_class'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_color');
    }
}
