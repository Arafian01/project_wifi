<?php

use App\Models\pembayaran;
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
        Schema::create('riwayat_pembayarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pembayaran_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('status_verifikasi', ['menunggu_verifikasi','diterima','ditolak']);
            $table->date('tanggal_verifikasi')->default(now());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_pembayarans');
    }
};
