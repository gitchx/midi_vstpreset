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
        Schema::create('vst_presets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('vst_name');
            $table->string('category')->nullable();
            $table->string('author')->nullable();
            $table->text('description')->nullable();
            $table->string('file_path');
            $table->string('format')->default('fxp');
            $table->json('tags')->nullable();
            $table->boolean('favorite')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vst_presets');
    }
};
