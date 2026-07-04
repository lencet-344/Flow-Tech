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
        Schema::create('orders', function (Blueprint $table) {
            $table->increments("id");
            $table->integer("quantity",20);
            $table->decimal("price", 8, 2);
            $table->decimal("cost", 8, 2);
            $table->date("date_delivery");

            $table->integer("buy_verification_id")->unsigned();
            $table->foreign("buy_verification_id")->references("id")->on("buy_verifications")->onDelete("cascade")->onUpdate("cascade");

            $table->integer("user_id")->unsigned();
            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade")->onUpdate("cascade");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
