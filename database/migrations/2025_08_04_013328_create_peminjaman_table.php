<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('peminjamans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bidang_id')->nullable()->constrained('bidangs')->onDelete('cascade');
            $table->string('bidang_manual')->nullable(); // jika pilih "lainnya"
            $table->foreignId('ruang_id')->constrained('ruangs')->onDelete('cascade');
            $table->date('tanggal');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->string('nama_acara');
            $table->integer('jumlah_peserta');
            $table->string('penanggung_jawab');
            $table->text('keterangan')->nullable();
            $table->enum('status', ['pending', 'ongoing', 'completed'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peminjamans');
    }
};
