<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGameSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_sessions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('visit_token')->nullable();
            $table->string('game_token')->unique()->nullable();
            $table->string('ip')->nullable();
            $table->string('device_type')->nullable();
            $table->string('job')->nullable();
            $table->string('location')->nullable();
            $table->integer('round1')->default(0);
            $table->integer('round2')->default(0);
            $table->integer('round3')->default(0);
            $table->integer('total_results')->default(0);
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
        Schema::dropIfExists('game_sessions');
    }
}
