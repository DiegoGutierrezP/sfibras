<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdenComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orden_compras', function (Blueprint $table) {
            $table->id();

            /* $table->text('descripcion');
            $table->date('fecha_inicio');
            $table->date('fecha_final')->nullable();
            $table->date('fecha_entrega')->nullable();
            $table->enum('estado_orden',[1,2,3,4]);//1 comienzo, 2 en proceso, 3 terminado, 4 entregado
            $table->enum('estado_pago',['deuda','pagado'])->nullable();//1 debe, 2 pagado
            $table->enum('moneda',['soles','dolares']);
            $table->decimal('precio_venta',10,2);
            $table->decimal('precio_total_igv',10,2); */
            $table->string('codigoOC')->nullable();
            $table->date('fechaRegistroOC');
            $table->text('observaciones')->nullable();
            $table->date('fechaInicioTrabajo')->nullable();
            $table->date('fechaFinalTrabajo')->nullable();
            $table->date('fechaEntrega')->nullable();
            $table->string('entregaEstimada')->nullable();
            $table->string('formaPago')->nullable();//
            $table->string('tipoMoneda');
            $table->decimal('valorDolar',10,3)->nullable();
            $table->enum('estadoPedido',[1,2,3,4])->default(1);
            $table->enum('estadoPago',[1,2])->default(1);
            $table->decimal('precioNetoOC',10,2);
            $table->string('descuentoOC')->nullable();
            $table->decimal('precioSubTotalOC',10,2);
            $table->decimal('precioIgvOC',10,2);
            $table->decimal('precioEnvioOC',10,2);
            $table->decimal('precioTotalOC',10,2);

            $table->unsignedBigInteger('cliente_id');
            $table->foreign('cliente_id')->references('id')->on('clientes');

            $table->unsignedBigInteger('cotizacion_id')->nullable();
            $table->foreign('cotizacion_id')->references('id')->on('cotizaciones');


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
        Schema::dropIfExists('orden_compras');
    }
}
