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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('subject_id');
            $table->string('question');
            $table->json('options'); // Opsi jawaban dalam format JSON
            $table->string('answer');
            $table->timestamps();

            // Relasi ke tabel subjects
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');

            // Constraint unik untuk mencegah duplikasi
            $table->unique(['subject_id', 'question']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
