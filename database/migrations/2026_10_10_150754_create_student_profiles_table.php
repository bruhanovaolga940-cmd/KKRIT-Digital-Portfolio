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
    Schema::create('student_profiles', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->unique()->constrained('users')->cascadeOnDelete();

        $table->text('about')->nullable();
        $table->string('city', 150)->nullable();
        $table->string('avatar_path', 500)->nullable();
        $table->string('education')->nullable();
        $table->string('specialization')->nullable();
        $table->year('graduation_year')->nullable();
        $table->boolean('profile_is_public')->default(true);

        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('student_profiles');
}
};
