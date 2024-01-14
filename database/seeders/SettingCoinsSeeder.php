<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingCoinsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('setting_coins')->insert([    
            'coins_name_en' => "SR",
            'coins_name_ar' => "ريال سعودي",

        ]);

        DB::table('setting_coins')->insert([    
            'coins_name_en' => "American dollar",
            'coins_name_ar' => "دولار امريكي ",

        ]);

    }
}
