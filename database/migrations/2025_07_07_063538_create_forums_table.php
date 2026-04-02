<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('forums', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('kategori_forum_id')->constrained('kategori_forums')->onDelete('cascade');
            $table->string('judul');
            $table->text('isi');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');

            $table->timestamps();

            $table->softDeletes(); // Tambahkan ini untuk kolom deleted_at (soft delete)
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('forums');
    }
};
