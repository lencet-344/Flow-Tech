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
            Schema::table('products', function (Blueprint $table) {
            // Agregamos la columna 'image', permitiendo que sea nula por si un producto no tiene foto
            $table->string('image')->nullable()->after('code_bar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Esto permite revertir el cambio si es necesario
            $table->dropColumn('image');
        });
    }
};
