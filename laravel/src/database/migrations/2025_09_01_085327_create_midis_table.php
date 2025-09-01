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
        Schema::create('midis', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('composer')->nullable();
            $table->string('genre')->nullable();
            $table->integer('bpm')->nullable();
            $table->string('key_signature')->nullable();
            $table->integer('time_signature_numerator')->nullable();
            $table->integer('time_signature_denominator')->nullable();
            $table->integer('length_seconds')->nullable();
            $table->integer('tracks_count')->nullable();
            $table->string('file_path');
            $table->json('tags')->nullable();
            $table->boolean('favorite')->default(false);
            $table->text('description')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('midis');
    }
};
