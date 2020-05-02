<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('platos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('tipo_plato_id')->unsigned();
            $table->bigInteger('sopa_id')->nullable()->unsigned();
            $table->bigInteger('entrada_id')->nullable()->unsigned();
            $table->bigInteger('bebida_id')->nullable()->unsigned();
            $table->string('nombre');
            $table->decimal('precio',11,2);
            $table->date('fecha');
            $table->string('imagen');
            $table->timestamps();
            $table->foreign('tipo_plato_id')->references('id')->on('tipo_platos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('sopa_id')->references('id')->on('sopas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('entrada_id')->references('id')->on('entradas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('bebida_id')->references('id')->on('bebidas')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('platos');
    }
}
