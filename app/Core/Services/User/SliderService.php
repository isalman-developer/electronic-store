<?php

namespace App\Core\Services\User;

use Illuminate\Support\Facades\Cache;
use App\Core\Services\AbstractService;
use App\Core\Repositories\SliderRepository;

class SliderService extends AbstractService
{
    public function __construct(protected SliderRepository $sliderRepository)
    {
        parent::__construct($sliderRepository);
    }

    public function getSliders()
    {
        $sliders =  cache()->rememberForever('sliders', function () {
            $data = $this->sliderRepository->getAll(relations: ['media']);

            // If no sliders exist, set a default banner
            if ($data->isEmpty()) {
                return collect([
                    (object)[
                        'title' => 'Welcome to Our Store',
                        'description' => 'Explore the best quality products at the best prices.',
                        'redirect_link' => url('/'),
                        'image_url' => asset('user/images/slider/default-slider.png')
                    ]
                ]);
            }

            return $data;
        });

        return $sliders->map(function ($slider) {
            $slider->image_url = (isset($slider->media) && $slider->media->count() > 0)
                ? getFirstImageUrl($slider)
                : asset('user/images/slider/default-slider.png');

            return $slider;
        });
    }
}
