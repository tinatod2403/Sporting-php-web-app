<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplexesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complexes', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->text('images')->nullable();
            $table->text('logo')->nullable();
            $table->text('content')->nullable();
            $table->unsignedBigInteger('moderator_id');
            $table->timestamps();

            $table->foreign('moderator_id')->references('id')->on('moderators');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('complexes');
    }
}
