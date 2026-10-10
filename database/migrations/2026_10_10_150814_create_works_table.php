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
    Schema::create('works', function (Blueprint $table) {
        $table->id();
        $table->foreignId('student_id')->constrained('users')->cascadeOnDelete();

        $table->string('title');
        $table->text('description')->nullable();
        $table->string('project_url', 500)->nullable();
        $table->string('image_path', 500)->nullable();

        $table->boolean('is_public')->default(true);
        $table->timestamp('published_at')->nullable();

        $table->timestamps();

        $table->index(['is_public', 'published_at']);
    });
}

public function down(): void
{
    Schema::dropIfExists('works');
}
};
