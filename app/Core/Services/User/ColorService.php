<?php

namespace App\Core\Services\User;

use App\Core\Services\AbstractService;
use App\Core\Repositories\ColorRepository;

class ColorService extends AbstractService
{
    public function __construct(protected ColorRepository $colorRepository)
    {
        parent::__construct($colorRepository);
    }

    public function getColors()
    {
        return cache()->rememberForever("colors", function () {
            return $this->colorRepository->getAll();
        });
    }
}
