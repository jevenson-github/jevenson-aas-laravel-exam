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
        Schema::create('positions', function (Blueprint $table) {
            $table->id();
            $table->string('position_name'); 
            $table->foreignId('reports_to_id')      
            ->nullable()
            ->constrained(table:'positions')
            ->onUpdate('cascade')
            ->onDelete('cascade')
            ; 
            $table->timestamps(); 
            
            // Index position_name for faster searching . 
            $table->index('position_name'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('positions');
    }
};
