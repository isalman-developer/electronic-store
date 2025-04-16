<?php

namespace App\Core\Services\User;

use Illuminate\Support\Facades\DB;
use App\Core\Services\AbstractService;
use App\Core\Repositories\ProductRepository;

class ProductService extends AbstractService
{
    public function __construct(protected ProductRepository $productRepository)
    {
        parent::__construct($productRepository);
    }

    public function getNewArrivals()
    {
        return $this->productRepository->getNewArrivals(perPage: 10, relations: ['media', 'sizes','brand'], orderBy: ['created_at' => 'desc']);
    }

    public function getNewArrivalsForHomePage()
    {
        return cache()->rememberForever('home_new_arrivals', function () {
            return $this->getNewArrivals();
        });
    }
}
