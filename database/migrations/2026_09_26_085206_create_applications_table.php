<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();

            $table->string('nama_lengkap');

            $table->enum('tipe_pengajuan', [
                'Sepeda Motor',
                'Mobil',
                'Multiguna'
            ]);

            $table->decimal('nominal', 15, 2);

            $table->unsignedInteger('tenor');

            $table->decimal('pendapatan_bulanan', 15, 2);

            $table->decimal('cicilan_per_bulan', 15, 2);

            $table->text('catatan')->nullable();

            $table->enum('status', [
                'Pending',
                'Disetujui',
                'Ditolak'
            ])->default('Pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};