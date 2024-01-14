<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacilityOwnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facility_owners', function (Blueprint $table) {
            $table->id();
            $table->string('name');//اسم مقدم الخدمة
            $table->string('name_corporation');//اسم المؤسسة
            $table->string('phone');//رقم الهاتف
            $table->string('password');//كلمة المرور
            $table->string('facebook_id')->default('-');
            $table->string('google_id')->default('-');
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
        Schema::dropIfExists('facility_owners');
    }
}
