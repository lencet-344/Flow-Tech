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
        Schema::create('contact_requests', function (Blueprint $table) {
            $table->id();
            $table->string("name", 30);
            $table->string("email", 30)->unique();
            $table->integer("telephone")->unique();
            $table->string("location", 30);

            $table->unsignedBigInteger("company_id");
            $table->foreign("company_id")->references("id")->on("companies")->onDelete("cascade")->onUpdate("cascade");


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_requests');
    }
};
