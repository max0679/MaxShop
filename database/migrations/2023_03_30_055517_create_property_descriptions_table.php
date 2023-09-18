<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyDescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_descriptions', function (Blueprint $table) {
            $table->mediumIncrements('id'); // unsigned mediumint
            $table->mediumInteger('category_id')->unsigned();
            $table->string('property_column', 3);
            $table->string('property_title', 32);
            $table->text('description')->nullable();
            $table->timestamps();

            $table->unique(['category_id', 'property_column'], 'unique_value');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('property_descriptions');
    }
}
