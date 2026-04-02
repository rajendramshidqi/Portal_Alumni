<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('informasi_lokers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_loker_id')->constrained('kategori_lokers')->onDelete('cascade');
            $table->string('judul');
            $table->string('lokasi');
            $table->string('gaji');
            $table->text('persyaratan');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('informasi_lokers');
    }
};
