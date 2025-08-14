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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
             $table->foreignId('contractor_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('project_type_id')->constrained('project_types')->onDelete('cascade');
            $table->float('area');
            $table->string('name');
            $table->float('budget_from');
            $table->float('budget_to');
            $table->boolean('open_budget')->default(false);
            $table->string('location');
            $table->integer('duration');
            $table->string('image');
            $table->date('start_date');
            $table->integer('status');
            $table->float('total_cost')->nullable();
            $table->string('cancel_reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
