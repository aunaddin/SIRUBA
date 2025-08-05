<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ruangs', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->integer('kapasitas');
            $table->string('lokasi');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ruangs');
    }
};

