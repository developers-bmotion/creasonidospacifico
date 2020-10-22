<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('teams', function (Blueprint $table) {
            //$table->unsignedInteger('type_document')->nullable();
            //$table->foreign('type_document')->references('id')->on('documenttypes');
            $table->string('second_last_name')->nullable()->after('last_name');
            $table->string('img_document_back')->nullable()->after('pdf_identificacion');
            $table->string('img_document_front')->nullable()->after('pdf_identificacion');
            //$table->unsignedInteger('place_expedition')->nullable();
            //$table->foreign('place_expedition')->references('id')->on('ciudad');
            $table->unsignedInteger('place_birth')->nullable();
            $table->foreign('place_birth')->references('id')->on('ciudad');
            $table->unsignedInteger('place_residence')->nullable();
            $table->foreign('place_residence')->references('id')->on('ciudad');
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('teams', function (Blueprint $table) {
            //$table->dropColumn('type_document');
            //$table->dropForeign('type_document');
            $table->dropColumn('second_last_name');
            $table->dropColumn('img_document_front');
            $table->dropColumn('img_document_back');
            //$table->dropColumn('place_expedition');
            //$table->dropForeign('place_expedition');
            $table->dropColumn('place_birth');
            $table->dropForeign('place_birth');
            $table->dropColumn('place_residence');
            $table->dropForeign('place_residence');
            $table->dropColumn('user_id');
            $table->dropForeign('user_id');
        });
    }
}
