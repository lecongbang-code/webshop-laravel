<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_product', function (Blueprint $table) {
            $table->Increments('id');
            $table->integer('id_category');
            $table->string('trademark');
            $table->string('name');
            $table->string('url_image');
            $table->string('url_product');
            $table->string('description');
            $table->string('old_price');
            $table->string('new_price');
            $table->string('discount_code');
            $table->string('ratio');
            $table->string('status');
            $table->string('status_adv');
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
        Schema::dropIfExists('tbl_product');
    }
}
