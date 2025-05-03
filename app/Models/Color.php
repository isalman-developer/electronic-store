<?php

namespace App\Models;

use App\Core\Model\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Color extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'color_class',
        'hex_code'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_color');
    }
}
