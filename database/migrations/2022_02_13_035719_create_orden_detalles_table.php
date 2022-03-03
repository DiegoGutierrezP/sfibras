<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdenDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orden_detalles', function (Blueprint $table) {
            $table->id();

            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->integer('cantidad');
            $table->string('unidad_medida')->nullable();
            $table->decimal('precioUnit',10,2);
            $table->decimal('precioTotal',10,2);
            $table->enum('estado',[1,2])->default(1);//1 no terminado, 2 terminado

            $table->unsignedBigInteger('orden_compra_id');
            $table->foreign('orden_compra_id')->references('id')->on('orden_compras')->onDelete('cascade');

            /* $table->unsignedBigInteger('producto_id');
            $table->foreign('producto_id')->references('id')->on('productos'); */


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
        Schema::dropIfExists('orden_detalles');
    }
}
