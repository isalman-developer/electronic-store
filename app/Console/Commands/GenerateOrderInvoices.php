<?php

namespace App\Console\Commands;

use App\Core\Services\Admin\InvoiceService;
use App\Models\Order;
use Illuminate\Console\Command;

class GenerateOrderInvoices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'orders:generate-invoices {--force : Force regenerate all invoices}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate invoice PDFs for orders that don\'t have them';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $invoiceService = app(InvoiceService::class);
        
        $query = Order::query();
        
        if (!$this->option('force')) {
            $query->whereNull('invoice_path');
        }
        
        $orders = $query->get();
        
        $count = $orders->count();
        
        if ($count === 0) {
            $this->info('No orders found that need invoices.');
            return 0;
        }
        
        $this->info("Generating invoices for {$count} orders...");
        
        $bar = $this->output->createProgressBar($count);
        $bar->start();
        
        foreach ($orders as $order) {
            $invoiceService->generateInvoice($order);
            $bar->advance();
        }
        
        $bar->finish();
        $this->newLine();
        $this->info('Invoice generation completed successfully!');
        
        return 0;
    }
}