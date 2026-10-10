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
    Schema::create('external_links', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();

        $table->string('platform', 100);   // GitHub, Behance, LinkedIn, VK
        $table->string('url', 500);
        $table->string('icon', 100)->nullable();
        $table->unsignedSmallInteger('sort_order')->default(0);

        $table->timestamp('created_at')->useCurrent();

        $table->index('user_id');
    });
}

public function down(): void
{
    Schema::dropIfExists('external_links');
}
};
