<?php

namespace App\Core\Repositories;

use App\Models\Color;
use App\Core\Repositories\AbstractRepository;

class ColorRepository extends AbstractRepository {

    public function __construct(Color $color)
    {
        parent::__construct($color);
    }

}
