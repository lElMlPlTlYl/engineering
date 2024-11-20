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
        Schema::create('permits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_id')
                ->nullable()
                ->constrained('owners');
            $table->date('date_applied')->nullable();
            $table->date('date_approved')->nullable();
            $table->string('project_title')->nullable();
            $table->string('or_number')->nullable();
            $table->float('area')->nullable();
            $table->integer('project_cost')->nullable();
            $table->string('civil_structural')->nullable();
            $table->string('building_permit')->nullable();
            $table->string('electrical_permit')->nullable();
            $table->string('sanitary_permit')->nullable();
            $table->string('architectural')->nullable();
            $table->string('fencing_permit')->nullable();
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permits');
    }
};
