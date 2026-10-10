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
    Schema::create('certificates', function (Blueprint $table) {
        $table->id();
        $table->foreignId('student_id')->constrained('users')->cascadeOnDelete();

        $table->string('title');
        $table->string('issuer')->nullable();
        $table->string('certificate_number')->nullable();
        $table->string('certificate_url', 500)->nullable();
        $table->date('issued_at')->nullable();
        $table->date('expires_at')->nullable();

        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('certificates');
}
};
