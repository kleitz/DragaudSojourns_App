<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTravelersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('travelers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('gender');
            $table->string('relationship');
            $table->string('emerg_name');
            $table->string('emerg_phone');
            $table->integer('user');
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
        Schema::dropIfExists('travelers');
    }
}
