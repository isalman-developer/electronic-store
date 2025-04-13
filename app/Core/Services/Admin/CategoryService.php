<?php

namespace App\Core\Services\Admin;

use App\Core\Repositories\CategoryRepository;
use App\Core\Services\AbstractService;

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
