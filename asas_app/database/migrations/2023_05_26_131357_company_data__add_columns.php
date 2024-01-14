<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CompanyDataAddColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("company_datas",function(Blueprint $table){
            $table->string('URL_WEBSITE')->nullable()->default(null);
            $table->string('FACEBOOK')->nullable()->default(null);
            $table->string('INSTEGRAM')->nullable()->default(null);
            $table->string('OTHER_TITLE')->nullable()->default(null);
            $table->string('NOTES_1')->nullable()->default(null);
            $table->string('NOTES_2')->nullable()->default(null);
            $table->string('NOTES_3')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("company_datas",function(Blueprint $table){
            $table->string('URL_WEBSITE')->nullable()->default(null);
            $table->string('FACEBOOK')->nullable()->default(null);
            $table->string('INSTEGRAM')->nullable()->default(null);
            $table->string('OTHER_TITLE')->nullable()->default(null);
            $table->string('NOTES_1')->nullable()->default(null);
            $table->string('NOTES_2')->nullable()->default(null);
            $table->string('NOTES_3')->nullable()->default(null);
        });
    }
}
