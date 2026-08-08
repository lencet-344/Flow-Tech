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
        Schema::create('suppliers', function (Blueprint $table) {
    $table->id();
    $table->string("name", 50);
    $table->integer("age"); 
    $table->string("gender", 10);
    $table->string("address", 100);
    $table->string("email", 50)->unique();
    $table->string("telephone", 15)->unique();
    $table->string("identification_card", 20)->unique();
    $table->string("company", 50);
    $table->string("code_company", 20);
    $table->string("no_INSS", 20)->unique();
    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
