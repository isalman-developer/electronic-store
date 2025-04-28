<?php

namespace App\Observers;

use App\Models\Color;
use Illuminate\Support\Str;

class ColorObserver
{
    public function creating(Color $color): void
    {
        $color->slug = Str::slug($color->title);
    }

    public function updating(Color $color): void
    {
        if ($color->isDirty('title')) {
            $color->slug = Str::slug($color->title);
        }
    }
}
