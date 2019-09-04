<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClicksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clicks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('sessionId')->nullable();
            $table->integer('position')->nullable();
            $table->integer('clickNo')->nullable();
            $table->string('sourceJobId')->nullable();
            $table->string('jobName')->nullable();
            $table->string('company')->nullable();
            $table->string('jobTitle')->nullable();
            $table->integer('round')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clicks');
    }
}
