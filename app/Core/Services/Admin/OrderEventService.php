<?php

namespace App\Core\Services\Admin;

use App\Core\Repositories\OrderEventRepository;

class OrderEventService
{
    public function __construct(protected OrderEventRepository $orderEventRepository) {}

    public function store(array $data)
    {
        return $this->orderEventRepository->store($data);
    }
}
