<?php

namespace App\Models;

use App\Core\Model\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'redirect_link', 'status'];
    protected $with = ['media'];
    public function media()
    {
        return $this->morphMany(Media::class, 'mediable');
    }
}
