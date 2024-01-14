<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurriculumTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //انواع المناهج
        Schema::create('curriculum_types', function (Blueprint $table) {
            $table->id();
            $table->string('name_en');//اسم المنهج الاساسي
            $table->string('name_ar');//اسم المنهج الاساسي
            $table->boolean('is_deleted')->default(false);
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
        Schema::dropIfExists('curriculum_types');
    }
}
