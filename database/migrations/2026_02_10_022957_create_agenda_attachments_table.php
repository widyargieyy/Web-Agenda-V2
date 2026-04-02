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
        Schema::create('agenda_attachments', function (Blueprint $table) {
            $table->id();
           
            $table->foreignId('agenda_id')->constrained('agendas')->cascadeOnDelete();
            $table->string('filename', 255);
            $table->string('filepath', 500);
            $table->string('mime_type', 100);
            $table->integer('file_size');
            $table->foreignId('uploaded_by')->constrained('users');
            $table->boolean('is_primary')->default(false);
            $table->timestamp('uploaded_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agenda_attachments');
    }
};