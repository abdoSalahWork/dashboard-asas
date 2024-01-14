<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('program_discounts', function (Blueprint $table) {
            $table->id();
            $table->string('id_program');
            $table->double('price_rate_discount')->default(0);// نسبة الخصم
            $table->string('start_discount')->default('-');// تاريخ بداية الخصم
            $table->string('end_discount')->default('-');//تاريخ نهاية الخصم
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
        Schema::dropIfExists('program_discounts');
    }
}
