<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; // Tambahkan ini di atas

return new class extends Migration
{
    public function up(): void
    {
        // Matikan pengecekan foreign key agar tidak dicegat oleh schedules/tasks
        if (DB::getDriverName() === 'sqlite') {
            DB::statement('PRAGMA foreign_keys = OFF;');
        }

        Schema::create('goals', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('category'); 
            $table->string('description')->nullable();
            $table->integer('progress')->default(0); 
            $table->timestamps();
        });

        // Nyalakan kembali setelah tabel goals berhasil dibuat
        if (DB::getDriverName() === 'sqlite') {
            DB::statement('PRAGMA foreign_keys = ON;');
        }
    }

    public function down(): void
    {
        if (DB::getDriverName() === 'sqlite') {
            DB::statement('PRAGMA foreign_keys = OFF;');
        }

        Schema::dropIfExists('goals');

        if (DB::getDriverName() === 'sqlite') {
            DB::statement('PRAGMA foreign_keys = ON;');
        }
    }
};