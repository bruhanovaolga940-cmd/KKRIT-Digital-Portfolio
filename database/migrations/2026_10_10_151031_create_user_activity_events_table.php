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
    Schema::create('applications', function (Blueprint $table) {
        $table->id();

        $table->foreignId('job_id')->constrained('jobs')->cascadeOnDelete();
        $table->foreignId('student_id')->constrained('users')->cascadeOnDelete();

        $table->text('message')->nullable();
        $table->enum('status', ['sent', 'viewed', 'accepted', 'rejected'])
            ->default('sent');

        $table->timestamp('applied_at')->useCurrent();
        $table->timestamps();

        $table->unique(['job_id', 'student_id']);
        $table->index(['student_id', 'status']);
        $table->index(['job_id', 'status']);
    });
}

public function down(): void
{
    Schema::dropIfExists('applications');
}
};
