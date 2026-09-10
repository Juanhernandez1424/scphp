<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('novedad', function (Blueprint $table) {
            $table->integer('id_reserva')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('novedad', function (Blueprint $table) {
            $table->integer('id_reserva')->nullable(false)->change();
        });
    }
};
