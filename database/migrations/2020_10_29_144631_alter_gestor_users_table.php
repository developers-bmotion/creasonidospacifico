<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterGestorUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedInteger('id_city')->nullable()->after('email_verified_at');
            $table->foreign('id_city')->references('id')->on('ciudad')->after('email_verified_at');
            $table->string('identification')->nullable()->after('email_verified_at');
            $table->unsignedInteger('document_type')->nullable()->after('email_verified_at');
            $table->foreign('document_type')->references('id')->on('documenttypes')->after('email_verified_at');
            $table->text('profile')->nullable()->after('email_verified_at');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
