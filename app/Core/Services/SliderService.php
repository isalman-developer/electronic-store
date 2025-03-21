<?php

namespace App\Core\Services;

use App\Core\Repositories\SliderRepository;
use Illuminate\Support\Facades\Cache;

class SliderService extends AbstractService
{
    public function __construct(protected SliderRepository $sliderRepository)
    {
        parent::__construct($sliderRepository);
    }

    public function getSliders()
    {
        return Cache::remember('home_sliders', 3600, function () {
            $sliders = $this->sliderRepository->getAll(relations: ['media']);

            return $sliders->map(function ($slider) {
                $slider->image_url = isset($slider->media) && $slider->media->count() > 0
                    ? getSingleImageUrl($slider)
                    : asset('assets/images/slider/slider-img-3.png');
                return $slider;
            });
        });
    }
}
