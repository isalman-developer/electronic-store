<?php

namespace App\Core\Repositories;

use App\Models\Category;
use App\Core\Repositories\AbstractRepository;

class CategoryRepository extends AbstractRepository {

    public function __construct(Category $category)
    {
        parent::__construct($category);
    }

}
