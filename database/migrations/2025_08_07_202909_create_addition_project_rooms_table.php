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
        Schema::create('addition_project_rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_room_id')->constrained()->onDelete('cascade');
            $table->foreignId('addition_type_id')->constrained()->onDelete('cascade');
            $table->integer('amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addition_project_rooms');
    }
};
