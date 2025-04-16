<?php

namespace App\Core\Services\User;

use App\Core\Services\AbstractService;
use App\Core\Repositories\SizeRepository;

class SizeService extends AbstractService
{
    public function __construct(protected SizeRepository $sizeRepository)
    {
        parent::__construct($sizeRepository);
    }

}
