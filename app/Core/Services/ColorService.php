<?php

namespace App\Core\Services;

use App\Core\Repositories\ColorRepository;
use Illuminate\Support\Facades\Cache;

class ColorService extends AbstractService
{
    public function __construct(protected ColorRepository $colorRepository)
    {
        parent::__construct($colorRepository);
    }

    public function geColorsForHomePage()
    {
        Cache::rememberForever('home_colors', function () {
            return $this->colorRepository->getAll();
        });
    }

}
