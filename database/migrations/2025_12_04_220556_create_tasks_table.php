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
Schema::create('tasks', function (Blueprint $table) {
        $table->id();
        $table->foreignId('project_id')->constrained()->onDelete('cascade'); // Pertence a um projeto
        $table->string('title');
        $table->text('description');
        $table->enum('status', ['pendente', 'em_progresso', 'concluida'])->default('pendente');
        $table->dateTime('due_date');
        $table->foreignId('assigned_to')->nullable()->constrained('users')->onDelete('set null'); // Quem vai fazer (pode ser nulo no início)
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
