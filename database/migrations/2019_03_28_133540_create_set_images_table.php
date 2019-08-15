<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSetImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('set_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('belong');
            $table->string('width');
            $table->string('height');
            $table->string('width_thu');
            $table->string('height_thu');
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
        Schema::dropIfExists('set_images');
    }
}
