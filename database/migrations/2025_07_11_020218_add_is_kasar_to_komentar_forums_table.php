<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('komentar_forums', function (Blueprint $table) {
            if (! Schema::hasColumn('komentar_forums', 'is_kasar')) {
                $table->boolean('is_kasar')->default(false)->after('isi');
            }

            if (! Schema::hasColumn('komentar_forums', 'is_read')) {
                $table->boolean('is_read')->default(false)->after('is_kasar');
            }

            if (! Schema::hasColumn('komentar_forums', 'deleted_at')) {
                $table->softDeletes(); 
            }
        });
    }

    public function down(): void
    {
        Schema::table('komentar_forums', function (Blueprint $table) {
            $table->dropColumn(['is_kasar', 'is_read', 'deleted_at']);
        });
    }
};
