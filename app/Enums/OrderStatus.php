<?php

namespace App\Enums;

enum OrderStatus: string
{
    case Pending = 'pending';
    case Paid = 'paid';
    case Shipped = 'shipped';
    case Completed = 'completed';
    case Canceled = 'canceled';
    case Refunded = 'refunded';
    case Returned = 'returned';

    public function label(): string
    {
        return config("order_statuses.{$this->value}.label", $this->value);
    }

    public function icon(): string
    {
        return config("order_statuses.{$this->value}.icon", 'bx bx-circle');
    }

    public function color(): string
    {
        return config("order_statuses.{$this->value}.color", '#64748b');
    }

    public function bgColor(): string
    {
        return config("order_statuses.{$this->value}.bg_color", '#f1f5f9');
    }

    public function borderColor(): string
    {
        return config("order_statuses.{$this->value}.border_color", '#cbd5e1');
    }

    public function tooltip(): string
    {
        return config("order_statuses.{$this->value}.tooltip", '');
    }

    public function description(): string
    {
        return config("order_statuses.{$this->value}.description", '');
    }

    public function nextStatuses(): array
    {
        return config("order_statuses.{$this->value}.next", []);
    }

    public function canTransitionTo(OrderStatus $status): bool
    {
        return in_array($status->value, $this->nextStatuses());
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
