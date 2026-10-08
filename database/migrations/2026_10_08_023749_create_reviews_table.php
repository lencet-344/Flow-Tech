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
    Schema::create('reviews', function (Blueprint $table) {
        $table->id();
        // Relaciona la reseña con el usuario registrado
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        
        $table->tinyInteger('rating'); // tinyInteger ahorra espacio en MySQL para números del 1 al 5
        $table->text('comment')->nullable(); // El comentario queda como opcional
        
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
