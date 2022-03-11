<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();

            $table->decimal('monto',10,2);
            $table->date('fecha_pago');
            $table->enum('moneda',['soles','dolares'])->nullable();
            $table->string('tipo_pago')->nullable();

            $table->unsignedBigInteger('orden_compra_id');
            $table->foreign('orden_compra_id')->references('id')->on('orden_compras')->onDelete('cascade');

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
        Schema::dropIfExists('pagos');
    }
}
