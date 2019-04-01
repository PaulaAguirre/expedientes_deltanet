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
            $table->string('estado')->nullable();
            $table->dateTime('fecha_entrada')->nullable();
            $table->string('observaciones')->nullable();
            $table->string('observaciones_regularizacion')->nullable();
            $table->integer('aprobado_por')->nullable();
            $table->string('situacion')->nullable();
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
