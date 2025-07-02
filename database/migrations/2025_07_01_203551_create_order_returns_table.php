<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_returns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->enum('status', ['requested', 'approved', 'received', 'inspected', 'completed', 'rejected'])->default('requested');
            $table->text('return_reason');
            $table->text('return_address')->nullable();
            $table->string('return_tracking_number')->nullable();
            $table->string('return_courier')->nullable();
            $table->boolean('requires_refund')->default(true);
            $table->text('admin_notes')->nullable();
            $table->foreignId('processed_by')->nullable()->references('id')->on('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_returns');
    }
};
