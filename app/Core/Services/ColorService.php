<?php

namespace App\Core\Services;

use App\Core\Repositories\ColorRepository;

class ColorService extends AbstractService
{
    public function __construct(protected ColorRepository $colorRepository)
    {
        parent::__construct($colorRepository);
    }

}
