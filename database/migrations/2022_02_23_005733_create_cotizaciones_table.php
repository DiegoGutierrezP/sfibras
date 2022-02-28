<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCotizacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cotizaciones', function (Blueprint $table) {
            $table->id();

            $table->string('codigoCoti')->nullable();
            $table->date('fechaEmision');
            $table->string('diasExpiracion');
            $table->string('tiempoEntrega');
            $table->string('formaPago');
            $table->string('tipoMoneda');
            $table->decimal('valorDolar',10,3)->nullable();
            $table->string('referenciaCoti')->nullable();
            $table->text('introCoti')->nullable();
            $table->text('conclusionCoti')->nullable();
            $table->decimal('precioNetoCoti',10,2);
            $table->string('descuentoCoti')->nullable();
            $table->decimal('precioSubTotalCoti',10,2);
            $table->decimal('precioIgvCoti',10,2);
            $table->decimal('precioEnvioCoti',10,2);
            $table->decimal('precioTotalCoti',10,2);

            $table->string('clienteNombre')->nullable();
            $table->string('clienteDni')->nullable();
            $table->string('clienteRuc')->nullable();
            $table->string('clienteTelefono')->nullable();

            $table->enum('estado',[1,2,3,4,5])->default(1);//1:pendiente.cuando es creada \ 2:aceptada:cuando se asocia una orden de compra,3:aceptado pero modificado  \ 4:expirada.cuando paso de la fecha \ 5:rechazada

            $table->unsignedBigInteger('cliente_id')->nullable();
            $table->foreign('cliente_id')->references('id')->on('clientes');

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
        Schema::dropIfExists('cotizaciones');
    }
}
