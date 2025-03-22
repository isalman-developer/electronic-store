<?php

namespace App\Core\Services;

use App\Core\Repositories\CategoryRepository;

class CategoryService extends AbstractService
{
    public function __construct(protected CategoryRepository $categoryRepository)
    {
        parent::__construct($categoryRepository);
    }

    public function getCategoriesForHomePage()
    {
        return cache()->rememberForever("home_categories", function(){
            return $this->categoryRepository->getAll(relations:['media'], scopes:['active']);
        });
    }
}
