<?php

namespace App\Core\Services\User;

use App\Core\Repositories\CategoryRepository;
use App\Core\Services\AbstractService;

class CategoryService extends AbstractService
{
    public function __construct(protected CategoryRepository $categoryRepository)
    {
        parent::__construct($categoryRepository);
    }

    public function getCategories()
    {
        return cache()->rememberForever("categories", function(){
            return $this->categoryRepository->getAll(relations:['media'], scopes:['active']);
        });
    }
}
