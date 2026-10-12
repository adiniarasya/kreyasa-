<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_code')->unique();       // KRY-001
            $table->string('customer_name');
            $table->string('customer_wa');
            $table->text('note')->nullable();
            $table->decimal('total', 15, 2);
            $table->enum('payment_type', ['dp', 'lunas']);
            $table->decimal('amount_paid', 15, 2)->default(0);
            $table->decimal('remaining', 15, 2)->default(0);
            $table->string('status')->default('Menunggu Verifikasi Pembayaran');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};