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
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_visita');
            $table->longText('comentarios');
            $table->timestamps();

            $table->unsignedBigInteger('persona_id');
            $table->foreign('persona_id')->references('id')->on('people')->onDelete('cascade');

            $table->unsignedBigInteger('propiedad_id');
            $table->foreign('propiedad_id')->references('id')->on('properties')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('visits', function (Blueprint $table) {
            $table->dropForeign('visits_persona_id_foreign');
            $table->dropForeign('visits_propiedad_id_foreign');
        });
        Schema::dropIfExists('visits');
    }
};
