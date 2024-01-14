<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_rates', function (Blueprint $table) {
            $table->id();
            $table->string('id_company');//رقم المؤسسة
            $table->float('scientific_level');//المستوى العلمي
            $table->float('activity_level');//المستوى الانشطة
            $table->float('buildings_and_stadiums'); //المباني و الملاعب
            $table->float('attention_and_communication');//الاهتمام و الاتصال
            $table->float('discipline_and_cleanliness');//الانضباط و النظافة
            $table->float('rate_total');//التقيم الاجمالي
            $table->integer('count_rate');//عدد التقيمات
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
        Schema::dropIfExists('company_rates');
    }
}
