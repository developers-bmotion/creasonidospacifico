<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->string('timezone')->nullable()->after('group_name');
            $table->dateTime('original_datetime')->nullable()->after('group_name');
            $table->dateTime('published_at')->nullable()->after('group_name');
            $table->enum('rejected', [0,1,2])->default(0)->nullable()->after('group_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->string('timezone');
            $table->dateTime('original_datetime');
            $table->dateTime('published_at');
            $table->boolean('rejected');
        });
    }
}
