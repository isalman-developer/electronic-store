<?php

namespace App\Core\Repositories;

use App\Models\Order;
use App\Core\Repositories\AbstractRepository;

class OrderRepository extends AbstractRepository
{

    public function __construct(Order $order)
    {
        parent::__construct($order);
    }
}
