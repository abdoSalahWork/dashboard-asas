<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class import_program implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        $row[0] = 'id_facility_owner';
        $row[1] = 'name_en';
        $row[2] = 'name_ar';
        $row[3] = 'description_en';
        $row[4] = 'description_ar';
        $row[5] = 'id_timeType';
        $row[6] = 'id_typeProgram';
        $row[7] = 'price_main';
        $row[8] = 'age_conditions_en';
        $row[9] = 'age_conditions_ar';
        $row[10] = 'other_conditions_en';
        $row[11] = 'other_conditions_ar';
        $row[12] = 'image';
        $row[13] = 'other_fute';
        $row[14] = 'url_viedo';
        $row[15] = 'id_curriculum_type';
        $row[16] = 'price_note_en';
        $row[17] = 'price_note_ar';
    }
}
