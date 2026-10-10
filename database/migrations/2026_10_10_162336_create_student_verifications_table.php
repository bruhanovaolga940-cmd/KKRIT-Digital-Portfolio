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
        Schema::create('student_verifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();

            $table->string('student_number', 30);
            $table->string('declared_full_name');
            $table->string('declared_group', 50)->nullable();

            $table->foreignId('matched_registry_id')
                ->nullable()
                ->constrained('student_registry')
                ->nullOnDelete();
            $table->decimal('match_confidence', 4, 3)->nullable();

            $table->enum('status', ['pending', 'approved', 'rejected', 'expired'])
                ->default('pending');
            $table->text('reject_reason')->nullable();
            $table->foreignId('reviewed_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();
            $table->timestamp('reviewed_at')->nullable();
            $table->string('proof_file_path', 500)->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();

            $table->index('status');

            // Зависит только от status, а не от user_id, поэтому FK с CASCADE допустим.
            // Для pending-заявки равно 1, для остальных NULL.
            $table->tinyInteger('pending_flag')
                ->nullable()
                ->storedAs("CASE WHEN status = 'pending' THEN 1 END");

            // У одного пользователя может быть только одна pending-заявка.
            $table->unique(['user_id', 'pending_flag'], 'uq_stuver_user_pending');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_verifications');
    }
};
