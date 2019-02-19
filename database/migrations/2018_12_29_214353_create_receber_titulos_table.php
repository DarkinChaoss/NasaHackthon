<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceberTitulosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receber_titulos', function (Blueprint $table) {
            $table->increments('id');
            $table->date('data_inc');
            $table->date('data_venc');
            $table->boolean('baixado')->default(false);
            $table->double('valor', 8, 2);
            $table->string('observacao');
            $table->integer('cliente_id')->unsigned();
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
        Schema::dropIfExists('receber_titulos');
    }
}
