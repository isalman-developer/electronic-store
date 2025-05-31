<?php

namespace App\Core\Services\Admin;

use App\Core\Services\AbstractService;
use App\Core\Repositories\ProductRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductService extends AbstractService
{
    public function __construct(protected ProductRepository $productRepository)
    {
        parent::__construct($productRepository);
    }

    /**
     * Store a new product
     */
    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {
            // Generate slug
            $data['slug'] = Str::slug($data['title']);

            // Set is_featured to false if not provided
            $data['is_featured'] = isset($data['is_featured']) ? true : false;

            // Create product
            $product = $this->productRepository->store($data);

            // Attach colors if provided
            if (isset($data['colors']) && is_array($data['colors'])) {
                $product->colors()->attach($data['colors']);
            }

            // Attach sizes if provided
            if (isset($data['sizes']) && is_array($data['sizes'])) {
                $product->sizes()->attach($data['sizes']);
            }

            // Handle media if provided
            if (isset($data['media']) && is_array($data['media'])) {
                foreach ($data['media'] as $media) {
                    $product->media()->create([
                        'file_path' => $media,
                        'file_type' => 'image',
                    ]);
                }
            }

            return $product;
        });
    }

    /**
     * Update an existing product
     */
    public function update(int $id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            // Get the product
            $product = $this->productRepository->getById($id);

            // Generate slug if title changed
            if (isset($data['title']) && $product->title !== $data['title']) {
                $data['slug'] = Str::slug($data['title']);
            }

            // Set is_featured to false if not provided
            $data['is_featured'] = isset($data['is_featured']) ? true : false;

            // Update product
            $product = $this->productRepository->update($id, $data);

            // Sync colors if provided
            if (isset($data['colors'])) {
                $product->colors()->sync($data['colors']);
            }

            // Sync sizes if provided
            if (isset($data['sizes'])) {
                $product->sizes()->sync($data['sizes']);
            }

            // Handle media if provided
            if (isset($data['media']) && is_array($data['media'])) {
                foreach ($data['media'] as $media) {
                    $product->media()->create([
                        'file_path' => $media,
                        'file_type' => 'image',
                    ]);
                }
            }

            return $product;
        });
    }
}
