<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->mediumIncrements('id'); // unsigned tinyint
            $table->string('title', 32)->unique(); // varchar
            $table->string('alias', 32)->unique();
            $table->string('description', 32)->nullable();; // varchar
            $table->string('picture', 100)->nullable();
            $table->timestamps(); // 2 поля - created_at и updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
