<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListaChequeosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lista_chequeos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('codigo_lista')->unique();
            $table->date('fecha')->nullable();
            $table->string('horario', 50)->nullable();
            $table->string('instrucciones', 50)->nullable();
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
        Schema::dropIfExists('lista_chequeos');
    }
}
