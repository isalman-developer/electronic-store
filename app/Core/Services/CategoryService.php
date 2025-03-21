<?php

namespace App\Core\Services;

use App\Core\Repositories\CategoryRepository;

class CategoryService extends AbstractService
{
    public function __construct(protected CategoryRepository $categoryRepository)
    {
        parent::__construct($categoryRepository);
    }

}
