<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetallePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_pedidos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pedido_id')->unsigned();
            $table->bigInteger('plato_id')->unsigned();
            $table->integer('cantidad');
            $table->decimal('precio',11,2);
            $table->string('tipo');
            $table->string('entrada_sopa')->nullable();
            $table->text('comentario')->nullable();
            $table->foreign('plato_id')->references('id')->on('platos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('pedido_id')->references('id')->on('pedidos')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('detalle_pedidos');
    }
}
