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
    Schema::create('company_verifications', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();

        $table->string('legal_name');
        $table->string('inn', 20)->nullable();
        $table->string('ogrn', 20)->nullable();
        $table->string('website')->nullable();
        $table->string('contact_person')->nullable();
        $table->string('contact_phone', 50)->nullable();
        $table->string('document_path', 500)->nullable(); // скан или выписка

        $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
        $table->text('reject_reason')->nullable();
        $table->foreignId('reviewed_by')
            ->nullable()
            ->constrained('users')
            ->nullOnDelete();
        $table->timestamp('reviewed_at')->nullable();

        $table->timestamps();

        $table->index('status');
        $table->index('inn');
    });
}

public function down(): void
{
    Schema::dropIfExists('company_verifications');
}
};
