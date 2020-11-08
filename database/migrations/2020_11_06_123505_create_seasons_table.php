<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeasonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seasons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('serie_id')->index();
            $table->integer('number');
            $table->float('score')->default(0.0);
            $table->unsignedBigInteger('list_id')->index()->nullable();

            $table->foreign('list_id')
            ->references('list_id')
            ->on('users')
            ->onDelete('cascade');

            $table->foreign('serie_id')
                ->references('id')
                ->on('series')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seasons');
    }
}
