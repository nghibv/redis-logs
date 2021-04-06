<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivityLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 255);
            $table->bigInteger('causer_id');
            $table->string('causer_name', 100);
            $table->string('method', 10)->nullable(true);
            $table->string('route', 225)->nullable(true);
            $table->string('model', 100)->nullable(true);
            $table->string('description', 225);
            $table->longText('old')->nullable();
            $table->longText('new')->nullable();
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
        Schema::dropIfExists('activity_log');
    }
}
