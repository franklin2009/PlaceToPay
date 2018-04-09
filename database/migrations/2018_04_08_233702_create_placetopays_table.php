<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlacetopaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('placetopays', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('transactionID');
            $table->string('sessionID',32);
			$table->string('returnCode',30);
			$table->string('trazabilityCode',40)->nullable();
			$table->integer('transactionCycle')->nullable();
			$table->string('bankCurrency',3)->nullable();
			$table->float('bankFactor', 8, 2)->nullable();
			$table->string('bankURL',255)->nullable();
			$table->integer('responseCode')->nullable();
			$table->string('responseReasonCode',3)->nullable();
			$table->string('responseReasonText',255)->nullable();
			$table->string('estatus',1)->nullable()->default('0');
            $table->timestamps();
			//transactionID  int,  sessionID string 32, returnCode string 30, trazabilityCode string 40, transactionCycle int, bankCurrency string 3, bankFactor float, bankURL string 255, responseCode int, responseReasonCode string 3, responseReasonText string 255
			
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('placetopays');
    }
}
