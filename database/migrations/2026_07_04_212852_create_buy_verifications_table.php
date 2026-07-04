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
        Schema::create('buy_verifications', function (Blueprint $table) {
            $table->increments("id");
            $table->integer("quantity");
            $table->date("date_buy");
            $table->decimal("iva", 8, 2);
            $table->decimal("cost_total", 8, 2);

            $table->integer("order_id")->unsigned();
            $table->foreign("order_id")->references("id")->on("orders")->onDelete("cascade")->onUpdate("cascade");


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buy_verifications');
    }
};
