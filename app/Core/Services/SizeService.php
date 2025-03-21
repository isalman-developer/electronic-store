<?php

namespace App\Core\Services;

use App\Core\Repositories\SizeRepository;

class SizeService extends AbstractService
{
    public function __construct(protected SizeRepository $sizeRepository)
    {
        parent::__construct($sizeRepository);
    }

}
