<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estates', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table-> string ('realtype');
            $table-> tinyInteger('status')->default('1');
            $table-> integer('area');
            $table-> string('district');
            $table-> string('address');
            $table-> string ('transaction');
            $table-> integer('price');
            $table->text('contact_time')->nullable();
            $table-> text('description');
            $table-> string('filename');
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
        Schema::dropIfExists('estates');
    }
}
