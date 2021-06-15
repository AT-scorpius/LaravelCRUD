<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Products extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
        $table->charset = 'utf8mb4';
        $table->collation = 'utf8mb4_unicode_ci';
        $table->increments('id');
        $table->string('product_name')->unique();
        $table->unsignedInteger('mf_id');
        $table->foreign('mf_id')->references('id')
        ->on('manufacturers')
        ->onUpdate('cascade')
        ->onDelete('cascade');;
        $table->unsignedInteger('price');
        $table->unsignedInteger('quantity');
        $table->string('image');
        $table->string('description');
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
        //
    }
}
