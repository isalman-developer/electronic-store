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

    public function getBrandsForHomePage()
    {
        return cache()->rememberForever("home_brands", function(){
            return $this->brandRepository->getAll(relations:['media'], scopes:['active']);
        });
    }
}
