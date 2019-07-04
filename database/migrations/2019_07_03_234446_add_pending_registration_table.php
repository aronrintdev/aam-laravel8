<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPendingRegistrationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pending_registration', function (Blueprint $table) {
	    $table->bigIncrements('id');
            $table->string('email', 255)
                ->default('');

            $table->string('code', 255)
                ->default('');

            $table->datetime('verified_at')
                ->nullable()
                ->default(null);

            $table->json('request');

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
        Schema::table('pending_registration', function (Blueprint $table) {
            $table->drop();
        });
    }
}
