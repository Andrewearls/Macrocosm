<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserRequirementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_requirement', function (Blueprint $table) {
            // $table->increments('id');
            $table->timestamps();
            $table->primary(['user_id', 'requirement_id']);
            $table->integer('user_id');
            $table->integer('requirement_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_requirement');
    }
}
