<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCiCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ci_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('belong');
            $table->integer('parent_id')->nullable()->index();
            $table->integer('depth')->nullable();
            $table->integer('sort');
            $table->string('name');
            $table->string('visible')->default(1);
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
        Schema::dropIfExists('ci_categories');
    }
}
