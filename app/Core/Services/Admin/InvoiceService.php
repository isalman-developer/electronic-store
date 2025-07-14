<?php

namespace App\Core\Services\Admin;

use App\Models\Order;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderInvoice;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class InvoiceService
{
    /**
     * Generate invoice PDF for an order
     */
    public function generateInvoice(Order $order): string
    {
        // Load order with necessary relations
        $order->load(['items.product', 'user']);

        // Generate PDF
        $pdf = Pdf::loadView('admin.invoices.template', compact('order'));

        // Generate filename
        $filename = 'invoice-' . $order->order_number . '.pdf';

        // Store PDF in storage
        $path = 'invoices/' . $filename;
        Storage::put('public/' . $path, $pdf->output());

        // Update order with invoice path if not already set
        if (!$order->invoice_path) {
            $order->update(['invoice_path' => $path]);
        }

        return $path;
    }

    /**
     * Get invoice PDF as a response for download
     */
    public function downloadInvoice(Order $order)
    {
        // Check if invoice exists, generate if not
        if (!$order->invoice_path || !Storage::exists('public/' . $order->invoice_path)) {
            $this->generateInvoice($order);
        }

        return Storage::download('public/' . $order->invoice_path, 'invoice-' . $order->order_number . '.pdf');
    }

    /**
     * Send invoice email to customer
     */
    public function sendInvoiceEmail(Order $order): bool
    {
        // Check if invoice exists, generate if not
        if (!$order->invoice_path || !Storage::exists('public/' . $order->invoice_path)) {
            $this->generateInvoice($order);
        }

        // Send email with invoice
        Mail::to($order->email)->send(new OrderInvoice($order));

        return true;
    }

    /**
     * Resend invoice email to customer
     */
    public function resendInvoice(Order $order): bool
    {
        return $this->sendInvoiceEmail($order);
    }
}
