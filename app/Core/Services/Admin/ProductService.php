<?php

namespace App\Core\Services\Admin;

use Illuminate\Support\Facades\DB;
use App\Core\Services\AbstractService;
use App\Core\Repositories\ProductRepository;

class ProductService extends AbstractService
{
    public function __construct(protected ProductRepository $productRepository)
    {
        parent::__construct($productRepository);
    }

    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {
            $product = $this->repository->store($data);

            if (!empty($data['sizes'])) {
                $product->sizes()->sync($data['sizes']);
            }

            if (!empty($data['colors'])) {
                $product->colors()->sync($data['colors']);
            }

            return $product;
        });
    }

    public function update($id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            $product = $this->repository->update($id, $data);

            if (!empty($data['sizes'])) {
                $product->sizes()->sync($data['sizes']);
            }

            if (!empty($data['colors'])) {
                $product->colors()->sync($data['colors']);
            }

            return $product;
        });
    }

    public function getNewArrivals()
    {
        return $this->productRepository->getNewArrivals(perPage: 10, relations: ['media', 'sizes'], orderBy: ['created_at' => 'desc']);
    }

    public function getNewArrivalsForHomePage()
    {
        return cache()->rememberForever('home_new_arrivals', function () {
            return $this->getNewArrivals();
        });
    }
}
