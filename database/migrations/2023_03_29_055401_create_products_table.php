<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->mediumIncrements('id'); // unsigned mediumint
            $table->string('title', 64)->index(); // varchar
            $table->mediumInteger('category_id')->unsigned();
            $table->mediumInteger('manufacturer_id')->unsigned();
            $table->string('alias', 64)->unique();

            $table->decimal('price', 8, 2);
            $table->smallInteger('count')->unsigned()->default(0);
            $table->tinyInteger('status_id')->unsigned();
            $table->decimal('rating', 4, 2)->default(0.0);

            $table->mediumInteger("count_comments")->unsigned()->default(0);
            $table->integer("count_views")->unsigned()->default(0);

            $table->string('picture', 100)->nullable();
            $table->text('description')->nullable();


            $table->string('X1', 10)->nullable();
            $table->string('X2', 10)->nullable();
            $table->string('X3', 10)->nullable();
            $table->string('X4', 10)->nullable();
            $table->string('X5', 10)->nullable();

            $table->string('X6', 10)->nullable();
            $table->string('X7', 10)->nullable();
            $table->string('X8', 10)->nullable();
            $table->string('X9', 10)->nullable();
            $table->string('X10', 10)->nullable();

            $table->string('X11', 10)->nullable();
            $table->string('X12', 10)->nullable();
            $table->string('X13', 10)->nullable();
            $table->string('X14', 10)->nullable();
            $table->string('X15', 10)->nullable();

            $table->string('X16', 10)->nullable();
            $table->string('X17', 10)->nullable();
            $table->string('X18', 10)->nullable();
            $table->string('X19', 10)->nullable();
            $table->string('X20', 10)->nullable();

            $table->string('X21', 10)->nullable();
            $table->string('X22', 10)->nullable();
            $table->string('X23', 10)->nullable();
            $table->string('X24', 10)->nullable();
            $table->string('X25', 10)->nullable();

            $table->string('X26', 10)->nullable();
            $table->string('X27', 10)->nullable();
            $table->string('X28', 10)->nullable();
            $table->string('X29', 10)->nullable();
            $table->string('X30', 10)->nullable();

            $table->string('X31', 10)->nullable();
            $table->string('X32', 10)->nullable();
            $table->string('X33', 10)->nullable();
            $table->string('X34', 10)->nullable();
            $table->string('X35', 10)->nullable();

            $table->timestamps(); // 2 поля - created_at и updated_at


            $table->foreign('category_id')->references('id')->on('categories')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('manufacturer_id')->references('id')->on('manufacturers')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('status_id')->references('id')->on('stock_statuses')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
