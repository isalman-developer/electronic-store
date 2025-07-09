<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('order_number')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone');
            $table->text('shipping_address');
            $table->string('city');
            $table->string('state');
            $table->string('zip');
            $table->string('country', 2);
            $table->text('notes')->nullable();
            $table->string('payment_method');
            $table->string('payment_status')->default('pending');
            $table->decimal('total_amount', 10, 2);
            $table->enum('status', [
                'pending',
                'paid',
                'shipped',
                'delivered',
                'completed',
                'canceled',
            ])->default('pending');
            $table->boolean('is_returned')->default(false);
            $table->boolean('is_refunded')->default(false);
            $table->string('invoice_path')->nullable();
            $table->string('courier')->nullable();
            $table->string('tracking_number')->nullable();
            $table->string('shipping_method')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
