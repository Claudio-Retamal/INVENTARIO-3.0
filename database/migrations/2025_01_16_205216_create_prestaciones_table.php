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
        Schema::create('prestaciones', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->date('start');
            $table->date('end');
            $table->string('color');
            $table->string('observacion');
            $table->unsignedBiginteger('equipos_id')->nullable();
            $table->foreign('equipos_id')->references('id')->on('equipos')->nullable()->constrained()->onUpdate('cascade');
            $table->unsignedBiginteger('personals_id')->nullable();
            $table->foreign('personals_id')->references('id')->on('personals')->nullable()->constrained()->onUpdate('cascade');
            $table->integer('estado')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestaciones');
    }
};
