<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplexCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complex_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('complex_id');
            $table->unsignedBigInteger('category_id');
            $table->timestamps();

            $table->foreign('complex_id')->references('id')->on('complexes');
            $table->foreign('category_id')->references('id')->on('categories');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('complex_categories');
    }
}
