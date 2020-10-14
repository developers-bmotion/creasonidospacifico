<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterBeneficiariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('beneficiaries', function (Blueprint $table) {
            $table->string('img_document_back')->nullable()->after('pdf_documento');
            $table->string('img_document_front')->nullable()->after('pdf_documento'); 
            $table->unsignedInteger('place_residence')->nullable()->after('expedition_place');
            $table->foreign('place_residence')->references('id')->on('ciudad');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('beneficiaries', function (Blueprint $table) {
            $table->dropColumn('img_document_back');
            $table->dropColumn('img_document_front');
            $table->dropColumn('place_residence');
            $table->dropForeign('place_residence');
        });
    }
}
