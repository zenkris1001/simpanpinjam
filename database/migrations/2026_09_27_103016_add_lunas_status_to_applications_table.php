<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            ALTER TABLE applications
            MODIFY status ENUM('Pending', 'Disetujui', 'Ditolak', 'Lunas')
            DEFAULT 'Pending'
        ");
    }

    public function down(): void
    {
        DB::statement("
            ALTER TABLE applications
            MODIFY status ENUM('Pending', 'Disetujui', 'Ditolak')
            DEFAULT 'Pending'
        ");
    }
};