<?php

namespace App\Core\Repositories;

use App\Models\OrderEvent;

class OrderEventRepository extends AbstractRepository
{
    public function __construct(OrderEvent $orderEvent)
    {
        parent::__construct($orderEvent);
    }
}
