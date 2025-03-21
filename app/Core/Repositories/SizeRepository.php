<?php

namespace App\Core\Repositories;

use App\Models\Size;
use App\Core\Repositories\AbstractRepository;

class SizeRepository extends AbstractRepository {

    public function __construct(Size $size)
    {
        parent::__construct($size);
    }

}
