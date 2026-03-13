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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            // Menghubungkan ke tabel registrations
            $table->foreignId('registration_id')->constrained('registrations')->cascadeOnDelete();

            $table->integer('total_bill');    // Total tagihan (Harga Kamar * Malam)
            $table->integer('amount_paid');   // Jumlah yang dibayar tamu
            $table->integer('balance');       // Kembalian (jika ada)
            $table->string('payment_method'); // Cash, Transfer, Debit
            $table->string('receipt_number')->unique(); // Nomor struk otomatis
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
