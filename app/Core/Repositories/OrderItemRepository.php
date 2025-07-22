<?php

namespace App\Core\Repositories;

use App\Models\OrderItem;

class OrderItemRepository extends AbstractRepository
{
    public function __construct(OrderItem $orderItem)
    {
        parent::__construct($orderItem);
    }
}
