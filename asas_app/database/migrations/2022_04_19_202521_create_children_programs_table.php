<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChildrenProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('children_programs', function (Blueprint $table) {
            $table->id();
            $table->string('id_child');//الابناء
            $table->string('id_program');//البرنامج
            // $table->string('id_service');//خدمات اضافية
            $table->string('id_reservation_statuses')->default(1);//حالة الحجز
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
        Schema::dropIfExists('children_programs');
    }
}
