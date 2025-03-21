<?php

namespace App\Models;

use App\Traits\ModelScopes;
use App\Traits\HasMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory, HasMedia, ModelScopes;

    protected $fillable = ['title', 'description', 'redirect_link', 'status'];

    public function media()
    {
        return $this->morphMany(Media::class, 'mediable');
    }
}
