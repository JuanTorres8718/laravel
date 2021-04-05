<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFirmasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('firmas', function (Blueprint $table) {
            $table->id();
            $table->longText('imagen_firma')->nullable();
            $table->foreignId('lista_chequeo_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('instructor_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('observaciones', 50)->nullable();
            $table->string('estado', 50)->nullable(); 
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
        Schema::dropIfExists('firmas');
    }
}
