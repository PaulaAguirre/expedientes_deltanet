<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('histories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('expediente_id');
            $table->integer('area_id');
            $table->integer('orden');
            $table->string('estado');
            $table->dateTime('fecha_entrada');
            $table->string('observaciones');
            $table->string('observaciones_regularizacion');
            $table->integer('aprobado_por');
            $table->string('situacion');
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
        Schema::dropIfExists('histories');
    }
}
