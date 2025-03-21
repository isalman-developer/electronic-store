<?php

namespace App\Core\Repositories;

use App\Models\Slider;
use App\Core\Repositories\AbstractRepository;

class SliderRepository extends AbstractRepository {

    public function __construct(Slider $slider)
    {
        parent::__construct($slider);
    }

}
