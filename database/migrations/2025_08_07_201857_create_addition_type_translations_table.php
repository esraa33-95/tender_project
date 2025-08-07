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
        Schema::create('addition_type_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('addition_type_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('locale')->index();

            $table->unique(['addition_type_id', 'locale']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addition_type_translations');
    }
};
