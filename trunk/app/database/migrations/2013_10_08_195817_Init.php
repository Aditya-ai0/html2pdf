<?php

use Illuminate\Database\Migrations\Migration;

class Init extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //create user table
        Schema::create('users', function ($table) {
            $table->increments('id')->index()->unsigned();
            $table->string('accessUsername', 100);
            $table->string('accessKey', 100);
            $table->string('username', 255);
            $table->string('password', 100);
            $table->timestamps();
        });

        Schema::create('converters', function ($table) {
            $table->increments('id')->index()->unsigned();
            $table->string('name', 255);
            $table->string('location', 1000);
            $table->integer('status');
            $table->timestamps();
        });

        Schema::create('transactions', function ($table) {
            $table->increments('id')->index()->unsigned();
            $table->integer('converterId')->index()->unsigned();
            $table->foreign('converterId')->references('id')->on('converters')->onDelete('cascade')->onUpdate('cascade');
            $table->string('fileName', 1000)->nullable();
            $table->float('fileSize')->default(0);
            $table->integer('tokens')->default(1);
            $table->dateTime('startTime');
            $table->dateTime('endTime')->nullable();
            $table->integer('processId')->nullable();
            $table->boolean('isKilled')->default(false);
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
        Schema::table('transactions', function ($table) {
            $table->dropForeign('transactions_converterid_foreign');
        });

        Schema::drop('transactions');
        Schema::drop('converters');
        Schema::drop('users');
    }

}