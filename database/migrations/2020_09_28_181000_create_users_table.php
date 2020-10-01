<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('document_type_id')->unsigned();
            $table->string('document_number')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->date('born_date');
            $table->char('phone',9)->unique();
            $table->string('gender');
            $table->integer('clinic_id')->nullable()->unsigned();

            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();

            $table->foreign('clinic_id')->references('id')->on('clinics');
            $table->foreign('document_type_id')->references('id')->on('document_types');
            $table->index('born_date');
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
        Schema::dropIfExists('users');
    }
}
