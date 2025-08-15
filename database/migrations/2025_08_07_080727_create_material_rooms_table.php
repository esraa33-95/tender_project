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
        Schema::create('material_rooms', function (Blueprint $table) {
           $table->id();
           $table->foreignId('project_room_id')->constrained()->onDelete('cascade');
           $table->enum('material_type', ['ceil', 'wall', 'floor']);
           $table->foreignId('material_category_id')->constrained()->onDelete('cascade');
           $table->float('area')->default(0);
           $table->float('price')->default(0);
           $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('material_rooms');
    }
};
