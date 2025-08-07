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
        Schema::create('material_category_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('material_category_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('locale')->index();

            $table->unique(['material_category_id', 'locale'], 'material_cat_unique');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('material_category_translations');
    }
};
