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
        Schema::create('bookings', function (Blueprint $table) {
            $table->increments("id");
            $table->date("date_booking");
            $table->decimal("total_amount", 8, 2);
            $table->decimal("deposit_amount", 8, 2);
            $table->string("payment_method",30);
            $table->string("special_requests",100);

            $table->integer("supplier_id")->unsigned();
            $table->foreign("supplier_id")->references("id")->on("suppliers")->onDelete("cascade")->onUpdate("cascade");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
