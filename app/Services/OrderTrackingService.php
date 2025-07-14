<?php

namespace App\Services;

use Exception;
use App\Models\Order;
use App\Enums\OrderStatus;
use Illuminate\Support\Facades\DB;

class OrderTrackingService
{
    /**
     * Update order status with validation and timeline logging
     */
    public function updateStatus(Order $order, OrderStatus $newStatus, ?string $description = null, ?int $userId = null): Order
    {
        return DB::transaction(function () use ($order, $newStatus, $description, $userId) {
            // Validate status transition
            $currentStatus = OrderStatus::from($order->status);
            if (!$currentStatus->canTransitionTo($newStatus)) {
                throw new Exception("Invalid status transition from {$order->status} to {$newStatus->value}");
            }

            // Update order status
            $order->update(['status' => $newStatus->value]);

            // Clear any cached data
            $this->clearOrderCache($order);

            return $order->fresh();
        });
    }

    /**
     * Get order progress data for UI
     */
    public function getOrderProgress(Order $order): array
    {
        $statuses = config('order_statuses');
        $statusKeys = array_keys($statuses);
        $currentIndex = array_search($order->status, $statusKeys);

        return [
            'statuses' => $statuses,
            'current_index' => $currentIndex,
            'progress_percentage' => $this->calculateProgressPercentage($currentIndex, count($statusKeys)),
            'current_status' => $order->status,
            'next_statuses' => $this->getNextAvailableStatuses($order),
        ];
    }

    /**
     * Calculate progress percentage
     */
    private function calculateProgressPercentage(int $currentIndex, int $totalSteps): float
    {
        if ($totalSteps <= 1) return 100;
        return min(100, ($currentIndex / ($totalSteps - 1)) * 100);
    }

    /**
     * Get next available statuses for the order
     */
    public function getNextAvailableStatuses(Order $order): array
    {
        $currentStatus = OrderStatus::from($order->status);
        $nextStatuses = $currentStatus->nextStatuses();

        $availableStatuses = [];
        foreach ($nextStatuses as $statusKey) {
            $status = OrderStatus::from($statusKey);
            $availableStatuses[] = [
                'key' => $statusKey,
                'label' => $status->label(),
                'icon' => $status->icon(),
                'color' => $status->color(),
                'tooltip' => $status->tooltip(),
            ];
        }

        return $availableStatuses;
    }

    /**
     * Clear order-related cache
     */
    private function clearOrderCache(Order $order): void
    {
        // Clear any cached order data
        cache()->forget("order_{$order->id}");
    }

    /**
     * Get status transition buttons for admin UI
     */
    public function getStatusTransitionButtons(Order $order): array
    {
        $nextStatuses = $this->getNextAvailableStatuses($order);
        $buttons = [];

        foreach ($nextStatuses as $status) {
            $buttons[] = [
                'status' => $status['key'],
                'label' => "Mark as {$status['label']}",
                'color' => $this->getButtonColor($status['key']),
                'icon' => $status['icon'],
            ];
        }

        return $buttons;
    }

    /**
     * Get button color based on status
     */
    private function getButtonColor(string $status): string
    {
        return match ($status) {
            'canceled' => 'danger',
            'refunded' => 'warning',
            'returned' => 'warning',
            default => 'primary',
        };
    }
}
