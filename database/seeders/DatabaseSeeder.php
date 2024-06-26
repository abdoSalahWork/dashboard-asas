<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        DB::table('users')->insert([    
            'name' => "admin",
            'email'=>'admin@admin.com',
            'password' => Hash::make('102030405060'),
        ]);

        $this->call([
            SettingLanguegeSeeder::class,
            ReservationStatusSeeder::class,
            SettingCoinsSeeder::class,
        ]);
    }
}
