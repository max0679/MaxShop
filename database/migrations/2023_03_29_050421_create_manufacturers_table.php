<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManufacturersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manufacturers', function (Blueprint $table) {
            $table->mediumIncrements('id'); // unsigned mediumint
            $table->tinyInteger('country_id')->unsigned();
            $table->string('title', 32)->unique(); // varchar
            $table->string('description', 32)->nullable();; // varchar
            $table->timestamps(); // 2  поля - created_at и updated_at

            $table->foreign('country_id')->references('id')->on('countries')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('manufacturers');
    }
}
