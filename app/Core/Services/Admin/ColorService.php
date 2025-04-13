<?php

namespace App\Core\Services\Admin;

use Illuminate\Support\Facades\Cache;
use App\Core\Services\AbstractService;
use App\Core\Repositories\ColorRepository;

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
