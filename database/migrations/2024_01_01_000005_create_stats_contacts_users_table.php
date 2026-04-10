<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('stats', function (Blueprint $table) {
            $table->id();
            $table->string('value');      // e.g. "280"
            $table->string('suffix');     // e.g. "+"
            $table->string('label');      // e.g. "Proyek Selesai"
            $table->string('icon')->default('🏢');
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('contact_messages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('service')->nullable();
            $table->text('message');
            $table->boolean('is_read')->default(false);
            $table->timestamps();
        });

        // Tambah kolom role ke tabel users yang sudah ada (dibuat Laravel 12)
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'editor'])->default('editor')->after('password');
        });
    }

    public function down(): void {
        Schema::dropIfExists('stats');
        Schema::dropIfExists('contact_messages');
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
};
