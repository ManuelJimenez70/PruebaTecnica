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
        Schema::create('mueble__materials', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("mueble_id");
            $table->foreign('mueble_id')->references('id')->on('muebles');
            $table->unsignedBigInteger("material_id");
            $table->foreign('material_id')->references('id')->on('materials');
            $table->double("cantidad");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mueble__materials');
    }
};
