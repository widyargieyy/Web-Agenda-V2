<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
            Schema::create('agenda_documentations', function (Blueprint $table) {
                $table->id();
                $table->foreignId('agenda_id')->constrained('agendas')->cascadeOnDelete();
                $table->string('caption', 255)->nullable();
                $table->string('filename', 255);
                $table->string('filepath', 500);
                $table->string('file_type', 50);
                $table->foreignId('uploaded_by')->constrained('users');
                $table->timestamp('uploaded_at');

                $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agenda_documentations');
    }
};