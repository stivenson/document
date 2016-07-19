<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatedocumentsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
            1. Cambiar los binary a longblob
            2. Ajustar la longitud de los char
            3. Agregar "No negativos" y tamaño a futuras foraneas
            4. Agregar los indices y foraneas
        */
        Schema::create('documents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('headline');
            $table->boolean('reward');
            $table->char('status')->length(1);
            $table->char('telephone')->length(20);
            $table->integer('photos_id')->length(10)->unsigned();
            $table->integer('users_id')->length(10)->unsigned();
            $table->integer('type_documents_id')->length(10)->unsigned();
            $table->foreign('photos_id')->references('id')->on('photos');
            $table->foreign('users_id')->references('id')->on('users');
            $table->foreign('type_documents_id')->references('id')->on('typedocuments');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('documents');
    }
}
