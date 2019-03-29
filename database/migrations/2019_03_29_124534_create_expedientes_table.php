<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpedientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expedientes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('tipo_id');
            $table->integer('memo')->nullable();
            $table->dateTime('fecha_creacion');
            $table->integer('cliente_id');
            $table->integer('proveedor_id');
            $table->integer('ot_id');
            $table->string('referencia')->nullable();
            $table->double('monto_factura')->nullable();
            $table->double('monto_cheque')->nullable();
            $table->double('monto_contractual')->nullable();
            $table->integer('monto')->nullable();
            $table->integer('numero');
            $table->string('numero_factura');
            $table->string('notas')->nullable();
            $table->string('pdf')->nullable();
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
        Schema::dropIfExists('expedientes');
    }
}
