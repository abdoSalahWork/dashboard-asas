<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_datas', function (Blueprint $table) {
            $table->id();
            // $table->string('name_en');//اسم المؤسسة
            // $table->string('name_ar');//اسم المؤسسة
            // $table->string('main_img');//صورة المؤسسة الاساسية
            $table->string('logo');//صورة المؤسسة الخاصة بالشعار
            $table->longText('desception_en');//وصف المؤسسة
            $table->longText('desception_ar');//وصف المؤسسة
            $table->double('longitude');
            $table->double('latitude');
            $table->string('id_facility_owner');
            $table->boolean('is_deleted')->default(false);
            // $table->float('rate')->default(0); // تقيم المؤسسة  
            // $table->string('id_languege')->default('1');
            $table->string('id_coins')->default('1');
        
            $table->string('id_country')->default('1');
            $table->string('id_city')->default('1');
            
            $table->string('id_company_type');
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
        Schema::dropIfExists('company_datas');
    }
}
//MYSQL5044.site4now.net
// db_a852fd_asas
// 123asas123@##
