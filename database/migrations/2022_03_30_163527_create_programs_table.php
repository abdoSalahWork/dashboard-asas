<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->string('id_facility_owner');
            $table->string('name_en');//اسم البرانج بالانجليزي
            $table->string('name_ar');//اسم البرانج بالعربي
            $table->longText('description_en');//وصف البرانج بالانجليزي
            $table->longText('description_ar');//وصف البرانج بالعربي
            $table->string('id_timeType');//نوع الدوام
            $table->string('id_typeProgram');//نوع البرانج
            $table->double('price_main');//سعر البرانج
            // $table->double('price_rate_discount')->default(0);// نسبة الخصم
            // $table->string('start_discount')->default('-');// تاريخ بداية الخصم
            // $table->string('end_discount')->default('-');//تاريخ نهاية الخصم
            $table->string('age_conditions_en');//شروط العمر
            $table->string('age_conditions_ar');//شروط العمر
            $table->string('other_conditions_en')->default('-');//شروط اخرى
            $table->string('other_conditions_ar')->default('-');//شروط اخرى
            $table->string('image');//  صورة البرنامج الرئيسية
            $table->longText('other_fute');//مميزات حصرية للتطبيق
            $table->string('url_viedo')->default('-');//رابط الفيديو
            $table->string('id_curriculum_type');//نوع المنهج
            $table->string('price_note_en')->default('-');//ملاحظات سعر البرنامج
            $table->string('price_note_ar')->default('-');//ملاحظات سعر البرنامج
            $table->boolean('is_deleted')->default(false);//مشغل حذف
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
        Schema::dropIfExists('programs');
    }
}
