<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medics', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('collaborators_id');
            $table->foreign('collaborators_id')->references('id')->on('collaborators')->onDelete('cascade');
            $table->string('cliente')->nullable();
            $table->string('fechaexmedico')->nullable();
            $table->string('levantamientoobs')->nullable();
            $table->string('centromedico', 50)->nullable();
            $table->string('aptitud', 50)->nullable();
            $table->bigInteger('created_by')->unsigned()->index();
            $table->bigInteger('updated_by')->unsigned()->index();
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
        Schema::dropIfExists('medics');
    }
}
