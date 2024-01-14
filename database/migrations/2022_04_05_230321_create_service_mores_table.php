<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceMoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_mores', function (Blueprint $table) {
            $table->id();
            $table->string('service_en');//الخدمة انجليزي
            $table->string('service_ar');//الخدمة عربي
            $table->string('price');//السعر
            $table->string('id_program');//البرنامج
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
        Schema::dropIfExists('service_mores');
    }
}
