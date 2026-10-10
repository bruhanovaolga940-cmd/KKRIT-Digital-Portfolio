<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('password'); // Здесь хранится хеш пароля
            $table->string('fullname');

            $table->enum('role', ['student', 'company', 'admin']);
            $table->boolean('is_active')->default(true);

            $table->timestamp('blocked_at')->nullable();
            $table->text('blocked_reason')->nullable();
            $table->foreignId('blocked_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->enum('theme_preference', ['light', 'dark', 'system'])
                ->default('system');

            $table->timestamp('last_seen_at')->nullable();
            $table->timestamp('last_login_at')->nullable();
            $table->timestamp('last_meaningful_activity_at')->nullable();

            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->index(['role', 'is_active']);
            $table->index('last_seen_at');
            $table->index('last_meaningful_activity_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};