<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->double('price')->default(0);
            $table->string('alias')->unique();
            $table->string('image')->nullable();
            $table->string('make')->nullable();
            $table->string('model')->nullable();
            $table->date('regist_date')->nullable();
            $table->string('engine')->nullable();
            $table->text('description')->nullable();
            $table->string('category')->nullable();
            $table->tinyInteger('status')->default(0)->comment('0. Hidden 1. Active');
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
        Schema::dropIfExists('product');
    }
}
