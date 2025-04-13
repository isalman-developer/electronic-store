<?php

namespace App\Core\Repositories;

use App\Models\Brand;
use App\Core\Repositories\AbstractRepository;

class BrandRepository extends AbstractRepository {

    public function __construct(Brand $brand)
    {
        parent::__construct($brand);
    }

}
