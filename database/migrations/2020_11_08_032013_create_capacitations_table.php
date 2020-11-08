<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCapacitationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('capacitations', function (Blueprint $table) {
            $table->id();
            $table->unsignedbigInteger('collaborators_id');
            $table->foreign('collaborators_id')->references('id')->on('collaborators')->onDelete('cascade');
            $table->date('fechabambas')->nullable();
            $table->text('bambas')->nullable();
            $table->date('fechabrocal')->nullable();
            $table->text('brocal')->nullable();
            $table->date('fechaantapaccay')->nullable();
            $table->text('antapaccay')->nullable();
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
        Schema::dropIfExists('capacitations');
    }
}
