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
        Schema::create('courses', function (Blueprint $table) {
            $table->id('course_id');
            $table->string('title', 100);
            $table->text('description')->nullable();

            //para las relaciones
            $table->unsignedBigInteger('section_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('prerequisite_id')->nullable();

            //para las foreneas
            $table->foreign('section_id')->references('section_id')->on('sections')->onDelete('set null');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('prerequisite_id')->references('course_id')->on('courses')->onDelete('set null');

            $table->timestamps();//fecha de creacion
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
