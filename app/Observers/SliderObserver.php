<?php

namespace App\Observers;

use App\Models\Slider;
use Illuminate\Support\Facades\Cache;
use App\Core\Services\Admin\SliderService;

class SliderObserver
{

    public function __construct(protected SliderService $sliderService) {}

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

        Cache::rememberForever('home_sliders', function () {
            return $this->sliderService->getAll(relations: ['media'], scopes: ['active']);
        });
    }
}
