<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('videos', function (Blueprint $table) {
            // Ganti file_path dengan youtube_url
            $table->string('youtube_url')->after('title');
            $table->dropColumn('file_path');
            $table->dropColumn('thumbnail'); // YouTube punya thumbnail sendiri
        });
    }
    public function down(): void
    {
        Schema::table('videos', function (Blueprint $table) {
            $table->string('file_path')->after('title');
            $table->string('thumbnail')->nullable()->after('file_path');
            $table->dropColumn('youtube_url');
        });
    }
};
