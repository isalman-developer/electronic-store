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

    public function getSlidersForHomePage()
    {
        $sliders =  Cache::rememberForever('home_sliders', function () {
            $data = $this->sliderRepository->getAll(relations: ['media']);

            // If no sliders exist, set a default banner
            if ($data->isEmpty()) {
                return collect([
                    (object)[
                        'title' => 'Welcome to Our Store',
                        'description' => 'Explore the best quality products at the best prices.',
                        'redirect_link' => url('/'),
                        'image_url' => asset('assets/images/slider/default-slider.png')
                    ]
                ]);
            }

            return $data;
        });

        return $sliders->map(function ($slider) {
            $slider->image_url = ($slider->media && $slider->media->count() > 0)
                ? getSingleImageUrl($slider)
                : asset('assets/images/slider/default-slider.png');

            return $slider;
        });
    }
}
