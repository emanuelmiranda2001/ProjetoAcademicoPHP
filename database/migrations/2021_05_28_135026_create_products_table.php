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
    public function up(){
		Schema::create('products', function (Blueprint $table) {
		$table->increments('id');
		$table->string('title',150)->unique();
		$table->string('code',50)->unique();
		$table->text('description');
		$table->float('price',6,2);
		$table->text('image');
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
        Schema::dropIfExists('products');
    }
}
