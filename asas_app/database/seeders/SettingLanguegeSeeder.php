<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class SettingLanguegeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('setting_langueges')->insert([    
            'languege_name' => "عربي",
        ]);
        DB::table('setting_langueges')->insert([    
            'languege_name' => "Einglish",
        ]);
    }
}
