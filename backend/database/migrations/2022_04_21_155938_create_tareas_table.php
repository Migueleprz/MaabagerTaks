<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tareas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trabajadorId')->constrained('trabajadors');
            $table->string('title',50);
            $table->string('description',500);
            $table->date('delivery_date');
            $table->enum('status',['pendiente','cumplida','no cumplida'])->default('pendiente');
            $table->string('observation', 500)->nullable();
            $table->dateTime('observation_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tareas');
    }
};
