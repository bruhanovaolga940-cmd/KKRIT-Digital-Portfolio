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
    Schema::create('jobs', function (Blueprint $table) {
        $table->id();
        $table->foreignId('company_id')->constrained('companies')->cascadeOnDelete();

        $table->string('title');
        $table->text('description');
        $table->string('city', 150)->nullable();

        $table->enum('status', ['draft', 'published', 'closed'])
            ->default('draft');

        $table->timestamp('published_at')->nullable();

        $table->timestamps();

        $table->index(['company_id', 'status']);
        $table->index(['status', 'published_at']);
    });
}

public function down(): void
{
    Schema::dropIfExists('jobs');
}
};
