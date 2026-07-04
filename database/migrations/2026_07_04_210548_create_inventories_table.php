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
        Schema::create('inventories', function (Blueprint $table) {
            $table->increments("id");
            $table->integer("quantity",);
            $table->integer("batch_number",);
            $table->decimal("unit_cost", 8, 2);
            $table->string("status",30);
            $table->date("last_restock");
            $table->date("update_restock");

            $table->integer("product_id")->unsigned();
            $table->foreign("product_id")->references("id")->on("products")->onDelete("cascade")->onUpdate("cascade");

            $table->integer("supplier_id")->unsigned();
            $table->foreign("supplier_id")->references("id")->on("suppliers")->onDelete("cascade")->onUpdate("cascade");

            $table->integer("order_detail_id")->unsigned();
            $table->foreign("order_detail_id")->references("id")->on("order_details")->onDelete("cascade")->onUpdate("cascade");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
