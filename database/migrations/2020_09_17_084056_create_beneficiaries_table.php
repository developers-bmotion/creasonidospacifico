<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBeneficiariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beneficiaries', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('document_type')->nullable();
            $table->foreign('document_type')->references('id')->on('documenttypes');
            $table->string('identification')->nullable();
            $table->string('name');
            $table->string('last_name')->nullable();
            $table->string('second_last_name')->nullable();
            $table->string('pdf_documento')->nullable();
            $table->string('picture')->nullable();
            $table->string('phone')->nullable();
            $table->string('adress')->nullable();
            $table->longText('biography')->nullable();
            $table->timestamp('birthday')->nullable();
            $table->unsignedInteger('cities_id')->nullable();
            $table->foreign('cities_id')->references('id')->on('ciudad');
            $table->string('township')->nullable();
            $table->unsignedInteger('expedition_place')->nullable();
            $table->foreign('expedition_place')->references('id')->on('ciudad');
            $table->unsignedInteger('artist_id')->nullable();
            $table->foreign('artist_id')->references('id')->on('artists');
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
        Schema::dropIfExists('beneficiaries');
    }
}
