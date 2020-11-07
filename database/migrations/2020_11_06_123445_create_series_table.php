<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('series', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('seasons_qt');
            $table->string('image');
            $table->char('status');
            $table->float('score')->default(0.0);
            $table->unsignedBigInteger('serie_list_id')->index();
            $table->timestamps();


            $table->foreign('serie_list_id')
                ->references('id')
                ->on('series_list')
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
        Schema::dropIfExists('series');
    }
}
