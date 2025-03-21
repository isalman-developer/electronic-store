<?php

namespace App\Core\Repositories;

use App\Models\Product;
use App\Core\Repositories\AbstractRepository;

class ProductRepository extends AbstractRepository
{

    public function __construct(Product $product)
    {
        parent::__construct($product);
    }

    public function getNewArrivals($perPage, $relations = [], $orderBy)
    {
        return $this->getAll(relations: $relations, orderBy: $orderBy, perPage: $perPage);
    }
}
