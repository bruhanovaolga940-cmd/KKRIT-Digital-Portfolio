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
        Schema::create('student_registry', function (Blueprint $table) {
            $table->id();
            $table->string('student_number', 30)->unique();   // номер зачётки
            $table->string('full_name');                      // ФИО по списку
            $table->string('group_name', 50)->nullable();
            $table->string('specialty')->nullable();
            $table->unsignedTinyInteger('course')->nullable();
            $table->date('enrolled_at')->nullable();

            // Дата выпуска или отчисления: по ней закрывается доступ
            $table->date('exited_at')->nullable();
            $table->enum('study_status', ['active', 'graduated', 'expelled', 'academic_leave'])
                ->default('active');

            $table->timestamp('imported_at')->useCurrent();
            $table->string('source_batch', 100)->nullable(); // идентификатор импорта

            $table->index('group_name');
            $table->index('study_status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_registry');
    }
};
