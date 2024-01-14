<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;



class import_F_C_P implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
            $row[0] = 'name';
            $row[1] = 'name_corporation';
            $row[2] = 'phone';
            $row[3] = 'password';
            $row[4] = 'logo';
            $row[5] = 'desception_en';
            $row[6] = 'desception_ar';
            $row[7] = 'lat';
            $row[8] = 'lng';
            $row[9] = 'id_coins';
            $row[10] = 'id_country';
            $row[11] = 'id_city';
            $row[12] = 'id_company_type';





    }
}
