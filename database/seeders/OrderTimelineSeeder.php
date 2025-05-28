<?php

namespace Database\Seeders;

use App\Core\Services\Admin\OrderTimelineService;
use App\Models\Order;
use Illuminate\Database\Seeder;

class OrderTimelineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $timelineService = app(OrderTimelineService::class);
        
        // Get all orders that don't have timeline entries yet
        $orders = Order::whereDoesntHave('timelines')->get();
        
        foreach ($orders as $order) {
            $timelineService->createDefaultTimeline($order);
        }
        
        $this->command->info('Created timeline entries for ' . $orders->count() . ' orders.');
    }
}