<?php

namespace App\Core\Services\User;

use App\Core\Services\AbstractService;
use App\Core\Repositories\BrandRepository;

class BrandService extends AbstractService
{
    public function __construct(protected BrandRepository $brandRepository)
    {
        parent::__construct($brandRepository);
    }

    public function getBrands()
    {
        return cache()->rememberForever("brands", function(){
            return $this->brandRepository->getAll(relations:['media'], scopes:['active']);
        });
    }
}
