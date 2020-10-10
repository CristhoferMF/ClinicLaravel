<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAvailabilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('availabilities', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('doctor_id')->unsigned();
            $table->bigInteger('specialty_id')->unsigned();

            $table->integer('day');
            $table->time('from_hour');
            $table->time('to_hour');
            $table->integer('max_patients');
            $table->date('from_date');
            $table->date('to_date')->nullable();
            $table->string('status');
            $table->timestamps();

            $table->foreign('doctor_id')->references('id')->on('doctors');
            $table->foreign('specialty_id')->references('id')->on('specialties');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('availabilities');
    }
}
