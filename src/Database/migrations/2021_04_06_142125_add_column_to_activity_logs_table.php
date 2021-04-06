<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToActivityLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('activity_logs', function (Blueprint $table) {
            $table->string('action', 50);
            $table->string('object', 100)->nullable(true);
            $table->bigInteger('object_id')->nullable(true);
            $table->string('object_name', 100)->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('activity_logs', function (Blueprint $table) {
            $table->dropColumn('action');
            $table->dropColumn('object');
            $table->dropColumn('object_id');
            $table->dropColumn('object_name');
        });
    }
}
