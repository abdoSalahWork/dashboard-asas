<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFahterChildrensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fahter_childrens', function (Blueprint $table) {
            $table->id();
            $table->string('id_father');
            $table->string('name');
            $table->string('name_father');
            $table->string('date_of_birth');//تاريخ الميلاد
            $table->string('gender');//الجنس
            $table->string('nationality')->default('-');//الجنسية
            $table->string('country_of_residence')->default('-');//دولة الاقامة
            $table->string('id_curriculum_type')->default('-');//نوع المنهج;
            $table->string('current_academic_certificates')->default('-');//الشهادات الدراسية الحالية
            $table->string('img')->default('-');
            $table->string('sports_of_interest')->default('-');//الرياضات محل الاهتمام
            $table->string('artistic_activities_of_interest')->default('-');//الأنشطة الفنية محل الاهتمام
            $table->string('religious_activities_of_interest')->default('-');//الانشطة الدينية محل الاهتمام
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
        Schema::dropIfExists('fahter_childrens');
    }
}
