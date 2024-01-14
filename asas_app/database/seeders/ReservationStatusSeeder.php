<?php


namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
class ReservationStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('reservation_statuses')->insert([    
        //     'status_en' => "pending",
        //     'status_ar'=>'قيد الانتظار',
        // ]);

        // DB::table('reservation_statuses')->insert([    
        //     'status_en' => "approved",
        //     'status_ar'=>'موافق',
        // ]);

        // DB::table('reservation_statuses')->insert([    
        //     'status_en' => "rejected",
        //     'status_ar'=>'مرفوض',
        // ]);

        // DB::table('reservation_statuses')->insert([    
        //     'status_en' => "canceled",
        //     'status_ar'=>'ملغي',
        // ]);

        // DB::table('reservation_statuses')->insert([    
        //     'status_en' => "completed",
        //     'status_ar'=>'منتهي',
        // ]);

        DB::table('reservation_statuses')->insert([    
            'status_en' => "under studying",
            'status_ar'=>'تحت الدراسة',
        ]);

        DB::table('reservation_statuses')->insert([    
            'status_en' => "acceptable",
            'status_ar'=>'مقبولة',
        ]);

        DB::table('reservation_statuses')->insert([    
            'status_en' => "rejected",
            'status_ar'=>'مرفوضة',
        ]);

        DB::table('reservation_statuses')->insert([    
            'status_en' => "canceled",
            'status_ar'=>'ملغاه',
        ]);

        DB::table('reservation_statuses')->insert([    
            'status_en' => "batch confirmed",
            'status_ar'=>'مؤكدة بدفعة',
        ]);
        


    }
}
