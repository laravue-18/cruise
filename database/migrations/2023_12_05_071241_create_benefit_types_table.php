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
        Schema::create('benefit_types', function (Blueprint $table) {
            $table->id();
            $table->integer('benefit_group_id');
            $table->string('name');
            $table->string('param');
            $table->boolean('eligible');
            $table->boolean('optional');
            $table->text('tooltip');
            $table->boolean('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('benefit_types');
    }
};
