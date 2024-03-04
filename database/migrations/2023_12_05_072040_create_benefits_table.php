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
        Schema::create('benefits', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id');
            $table->integer('benefit_type_id');
            $table->json('content');
            $table->string('value')->nullable();
            $table->integer('eligible')->nullable();
            $table->text('additional_info')->nullable();
            $table->integer('min_age')->default(0);
            $table->integer('max_age')->default(100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('benefits');
    }
};
