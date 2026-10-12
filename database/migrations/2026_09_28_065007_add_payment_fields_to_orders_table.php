<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('payment_method')->nullable()->after('payment_type');   // qris, dana, gopay, ovo, bca, dll
            $table->string('payment_proof')->nullable()->after('payment_method');  // path file bukti
            $table->timestamp('payment_uploaded_at')->nullable()->after('payment_proof');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['payment_method', 'payment_proof', 'payment_uploaded_at']);
        });
    }
};