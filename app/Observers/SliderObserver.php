<?php

namespace App\Observers;

use App\Models\Slider;
use Illuminate\Support\Facades\Cache;

class SliderObserver
{
    //it work for both saved and updated events
    public function saved(Slider $slider)
    {
        $this->clearAndRebuildCache();
    }

    public function deleted(Slider $slider)
    {
        $this->clearAndRebuildCache();
    }

    public function clearAndRebuildCache()
    {
        Cache::forget('home_sliders');
        $sliders = Slider::where('status', 1)->with('media')->get();

        if ($sliders->isEmpty()) {
            // If no banners exist, return a default array
            $sliders = collect([
                (object)[
                    'title' => 'Welcome to Our Store',
                    'description' => 'Explore the best quality products at the best prices.',
                    'redirect_link' => url('/')
                ]
            ]);
        }
        
        Cache::rememberForever('home_sliders', function () use ($sliders) {
            return $sliders;
        });
    }
}
