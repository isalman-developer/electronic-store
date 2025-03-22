<?php

namespace App\Models;

use App\Traits\HasMedia;
use App\Core\Model\Model;
use App\Traits\ModelScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'redirect_link', 'status'];

    public function media()
    {
        return $this->morphMany(Media::class, 'mediable');
    }
}
