<?php

namespace App\Core\Services\Admin;

use Illuminate\Support\Facades\Cache;
use App\Core\Services\AbstractService;
use App\Core\Repositories\SliderRepository;

class SliderService extends AbstractService
{
    public function __construct(protected SliderRepository $sliderRepository)
    {
        parent::__construct($sliderRepository);
    }

}
