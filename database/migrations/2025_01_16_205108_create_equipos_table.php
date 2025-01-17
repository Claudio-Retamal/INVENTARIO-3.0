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
        Schema::create('equipos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('serial');
            $table->string('modelo');
            $table->string('color');
            $table->unsignedBiginteger('salas_id')->nullable();
            $table->foreign('salas_id')->references('id')->on('salas')->nullable()->constrained()->onUpdate('cascade');
            $table->unsignedBiginteger('categorias_id')->nullable();
            $table->foreign('categorias_id')->references('id')->on('categorias')->nullable()->constrained()->onUpdate('cascade');            
            $table->integer('estado')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipos');
    }
};
