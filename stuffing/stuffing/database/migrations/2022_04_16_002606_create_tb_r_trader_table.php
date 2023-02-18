<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbRTraderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->down();
        Schema::connection('sqlsrv2')->create('tb_r_trader', function (Blueprint $table) {
            $table->integer('id_trader')->unsigned();
            $table->string('nm_trader');
            $table->string('al_trader');
            $table->string('kt_trader');
            $table->string('kd_negara');
            $table->bigInteger('npwp');
            $table->string('no_ktp');
            $table->string('no_izin');
            $table->string('email');
            $table->float('latitude');
            $table->float('longitude');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('sqlsrv2')->dropIfExists('tb_r_trader');
    }
}
