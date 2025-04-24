<?php

namespace App\Core\Services\Admin;

use App\Core\Services\AbstractService;
use App\Core\Repositories\BrandRepository;

class BrandService extends AbstractService
{
    public function __construct(protected BrandRepository $brandRepository)
    {
        parent::__construct($brandRepository);
    }

}
