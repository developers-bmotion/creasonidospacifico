<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('last_name')->nullable();

            $table->unsignedInteger('document_type')->nullable(); 
            $table->foreign('document_type')->references('id')->on('documenttypes');
            //$table->enum('document_type',['TI','CC'])->nullable(); se cambia el tipo de variable

            $table->string('identification')->nullable();

            $table->unsignedInteger('expedition_place')->nullable();
            $table->foreign('expedition_place')->references('id')->on('ciudad');
            //$table->string('expedition_place')->nullable(); se cambia el tipo de variable
            
            $table->timestamp('birthday')->nullable();
            $table->string('email')->nullable();
            $table->string('addres')->nullable();
            $table->string('phone1')->nullable();
            $table->string('phone2')->nullable();
            $table->string('pdf_identificacion')->nullable();
            $table->string('role')->nullable();
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
        Schema::dropIfExists('teams');
    }
}
