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
        Schema::create('agendas', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time')->nullable();

            $table->foreignId('category_id')->constrained('categories')->onUpdate('cascade');
            $table->foreignId('location_id')->nullable()->constrained('locations')->onUpdate('cascade');
            $table->string('place')->nullable();
            $table->foreignId('instansi_id')->nullable()->constrained('instansis')->onUpdate('cascade');
            $table->foreignId('unit_id')->nullable()->constrained('units')->onUpdate('cascade')->nullable();

            $table->enum('status', [
                'DRAFT',
                'PENDING',
                'APPROVED',
                'REJECTED',
                'COMPLETED',
                'CANCELLED',
            ]);
            
            $table->foreignId('created_by')->constrained('users')->onUpdate('cascade');
            $table->foreignId('approved_by')->nullable()->constrained('users')->onUpdate('cascade');
            $table->timestamp('approved_at')->nullable();
            $table->text('rejected_reason')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agendas');
    }
};