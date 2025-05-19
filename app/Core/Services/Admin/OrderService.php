<?php

namespace App\Core\Services\Admin;

use App\Core\Repositories\OrderRepository;
use App\Core\Services\AbstractService;

class OrderService extends AbstractService
{
    public function __construct(protected OrderRepository $orderRepository)
    {
        parent::__construct($orderRepository);
    }
}
